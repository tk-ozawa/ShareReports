<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Functions;
use App\Entity\Report;
use App\DAO\ReportDAO;
use App\DAO\ReportcateDAO;
use App\DAO\UserDAO;

/**
 * レポート管理に関するコントローラクラス
 */
class ReportController extends Controller
{
	/**
	 * レポートリスト画面表示処理
	 */
	public function showList(Request $request)
	{
		$templatePath = "report/list";
		$assign = [];
		$validationMsgs = [];
		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
			// reportsテーブルの全情報を取得
			$db = DB::connection()->getPdo();
			$reportDAO = new ReportDAO($db);
			$reportList = $reportDAO->findAll();
			if (empty($reportList)) {
				$request->session()->put('flash', 'レポートが登録されていません。');
			}
			$assign["reportList"] = $reportList;
		}
		return view($templatePath, $assign);
	}

	/**
	 * レポート登録画面表示処理
	 */
	public function goAdd(Request $request)
	{
		$templatePath = "report/add";
		$assign = [];
		$validationMsgs = [];
		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
			// reportcatesテーブルの全情報を取得
			$db = DB::connection()->getPdo();
			$reportcateDAO = new ReportcateDAO($db);
			$assign['reportcateList'] = $reportcateDAO->findAll();
		}
		return view($templatePath, $assign);
	}

	/**
	 * レポート登録処理
	 */
	public function add(Request $request)
	{
		$templatePath = "report/add";
		$assign = [];
		$isRedirect = false;
		$validationMsgs = [];
		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
			$rp = new Report();
			$rp->setRpDate($request->input('rpDate'));
			$rp->setRpTimeFrom($request->input('rpTimeFrom').':00');
			$rp->setRpTimeTo($request->input('rpTimeTo').':00');
			$rp->setReportCateId((int)$request->input('reportCateId'));
			$rp->setRpContent($request->input('rpContent'));
			$rp->setUserId($request->session()->get('usId'));

			// サーバ側バリデーション処理
			if (strtotime($rp->getRpTimeFrom()) > strtotime($rp->getRpTimeTo())) {
				$validationMsgs[] = "作業終了時刻が作業開始時刻以下のものが設定されています。正しい時刻を入力してください。";
			}

			if (empty($validationMsgs)) {
				$db = DB::connection()->getPdo();
				$reportDAO = new ReportDAO($db);
				$rpId = $reportDAO->insert($rp);
				if ($rpId === -1) {
					$assign["errorMsg"] = "レポート情報登録に失敗しました。もう一度はじめからやり直してください。";
					$templatePath = "error";
				}
				else {
					$isRedirect = true;
				}
			}
			else {
				// レポート登録画面に戻る
				$reportcateDAO = new ReportcateDAO($db);
				$assign['reportcateList'] = $reportcateDAO->findAll();
				$assign['validationMsgs'] = $validationMsgs;
			}
		}
		if ($isRedirect) {
			$response = redirect("./reports/showList")->with("flashMsg", "レポートID:".$rpId."でレポート情報を登録しました。");
		}
		else {
			$response = view($templatePath, $assign);
		}
		return $response;
	}

	/**
	 * レポート詳細画面表示処理
	 */
	public function showDetail(int $rpId, Request $request)
	{
		$templatePath = "report/detail";
		$assign = [];

		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
			$db = DB::connection()->getPdo();
			$reportDAO = new ReportDAO($db);

			// レポート情報
			$rp = $reportDAO->findByRpId($rpId);
			$rp->setRpTimeFrom(substr($rp->getRpTimeFrom(), 0, -3));
			$rp->setRpTimeTo(substr($rp->getRpTimeTo(), 0, -3));

			// 作業種類情報
			$reportcateDAO = new ReportcateDAO($db);
			$rpcate = $reportcateDAO->findById($rp->getReportCateId());

			// 投稿ユーザー情報
			$userDAO = new UserDAO($db);
			$us = $userDAO->findById($rp->getUserId());

			$assign['report'] = $rp;
			$assign['reportcate'] = $rpcate;
			$assign['user'] = $us;
		}
		return view($templatePath, $assign);
	}
}