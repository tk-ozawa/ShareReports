<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Functions;
use App\Entity\User;
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
			$db = DB::connection()->getPdo();
			$reportDAO = new ReportDAO($db);
			$case = 'id';
			if (!empty($request->input('case'))) {
				// カラムの指定があった時…
				$case = $request->input('case');
			}
			$orderBy = true;
			$assign["orderBy"] = 'ASC';
			if ($request->input('orderBy') === 'DESC') {
				// 並び順で降順が指定されていた時…
				$orderBy = false;
				$assign["orderBy"] = 'DESC';
			}
			// reportsテーブルの全情報を取得
			if (!empty($request->input('case'))) {
				// 並び替えオプション有
				$reportList = $reportDAO->findAll($case, $orderBy);
				$case = $request->input('case');
				$orderBy = $request->input('orderBy');
			}
			else {
				$reportList = $reportDAO->findAll();
			}
			$assign["case"] = $case;
			if (empty($reportList)) {
				$request->session()->put('flash', 'レポートが登録されていません。');
			}
			$assign["reportList"] = $reportList;
			// ナビゲーションバーの検索欄用
			$userDAO = new UserDAO($db);
			$assign["userList"] = $userDAO->findAll();
			$reportcateDAO = new ReportcateDAO($db);
			$assign["reportCateList"] = $reportcateDAO->findAll();
		}
		return view($templatePath, $assign);
	}

	/**
	 * レポート検索結果表示処理
	 */
	public function searchList(Request $request)
	{
		$templatePath = "report/resultList";
		$assign = [];
		$validationMsgs = [];
		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
			$db = DB::connection()->getPdo();
			$reportDAO = new ReportDAO($db);
			// 並び替え
			$case = 'id';
			if (!empty($request->input('case'))) {
				// カラムの指定があった時…
				$case = $request->input('case');
			}
			$assign["case"] = $case;
			$orderBy = true;
			if ($request->input('orderBy') === 'DESC') {
				// 並び順で降順が指定されていた時…
				$orderBy = false;
			}
			// dd($orderBy);
			$assign["orderBy"] = $orderBy;
			// 絞り込み
			$usId = $request->input('usId');
			$rcId = $request->input('rcId');
			$rpList = [];
			if ($usId === 'all' && $rcId === 'all') {
				// 全ユーザー & 全作業種類
				return redirect("./reports/showList");
			} else if ($usId === 'all' && $rcId !== 'all') {
				// 作業種類指定
				$rpList = $reportDAO->findByRcId((int)$rcId, $case, $orderBy);
			} else if ($usId !== 'all' && $rcId === 'all') {
				// ユーザー指定
				$rpList = $reportDAO->findByUsId((int)$usId, $case, $orderBy);
			} else {
				// ユーザー指定 & 作業種類指定
				$rpList = $reportDAO->findByUsIdAndRcId((int)$usId, (int)$rcId, $case, $orderBy);
			}

			$assign["reportList"] = $rpList;

			if ($usId !== 'all') {
				// 該当ユーザーのユーザー情報
				$userDAO = new UserDAO($db);
				$user = $userDAO->findById((int)$usId);
			}
			else {
				$user = new User();
				$user->setId(0);
			}
			$assign["user"] = $user;
			$assign["rcId"] = $rcId;
			// ナビゲーションバーの検索欄用
			$userDAO = new UserDAO($db);
			$assign["userList"] = $userDAO->findAll();
			$reportcateDAO = new ReportcateDAO($db);
			$assign["reportCateList"] = $reportcateDAO->findAll();
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
			// ナビゲーションバーの検索欄用
			$userDAO = new UserDAO($db);
			$assign["userList"] = $userDAO->findAll();
			$reportcateDAO = new ReportcateDAO($db);
			$assign["reportCateList"] = $reportcateDAO->findAll();
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
			$rp->setRpTimeFrom($request->input('rpTimeFrom').':00');	// MySQLのtime型(HH:MM:SS)に合わせる
			$rp->setRpTimeTo($request->input('rpTimeTo').':00');		// MySQLのtime型(HH:MM:SS)に合わせる
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
				// ナビゲーションバーの検索欄用
				$userDAO = new UserDAO($db);
				$assign["userList"] = $userDAO->findAll();
				$reportcateDAO = new ReportcateDAO($db);
				$assign["reportCateList"] = $reportcateDAO->findAll();
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
			// レポート情報
			$reportDAO = new ReportDAO($db);
			$rp = $reportDAO->findByRpId($rpId);
			$rp->setRpTimeFrom(substr($rp->getRpTimeFrom(), 0, -3));	// HTML上の時刻の形式(HH:MM)に合わせる
			$rp->setRpTimeTo(substr($rp->getRpTimeTo(), 0, -3));		// HTML上の時刻の形式(HH:MM)に合わせる
			$assign['report'] = $rp;
			// 作業種類情報
			$reportcateDAO = new ReportcateDAO($db);
			$rpcate = $reportcateDAO->findById($rp->getReportCateId());
			$assign['reportcate'] = $rpcate;
			// 投稿ユーザー情報
			$userDAO = new UserDAO($db);
			$us = $userDAO->findById($rp->getUserId());
			$assign['user'] = $us;
			// ナビゲーションバーの検索欄用
			$userDAO = new UserDAO($db);
			$assign["userList"] = $userDAO->findAll();
			$reportcateDAO = new ReportcateDAO($db);
			$assign["reportCateList"] = $reportcateDAO->findAll();
	}
		return view($templatePath, $assign);
	}

	/**
	 * レポート情報編集画面表示処理
	 */
	public function prepareEdit(int $rpId, Request $request)
	{
		$templatePath = "report/edit";
		$assign = [];
		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
			$db = DB::connection()->getPdo();
			$reportDAO = new ReportDAO($db);
			$rp = $reportDAO->findByRpId($rpId);
			if (empty($rp)) {
				$assign["errorMsg"] = "レポート情報の取得に失敗しました。";
				$templatePath = "error";
			}
			else {
				$rp->setRpTimeFrom(substr($rp->getRpTimeFrom(), 0, -3));	// HTML上の時刻の形式(HH:MM)に合わせる
				$rp->setRpTimeTo(substr($rp->getRpTimeTo(), 0, -3));		// HTML上の時刻の形式(HH:MM)に合わせる
				// 全作業種類取得
				$reportcateDAO = new ReportcateDAO($db);
				$rcList = $reportcateDAO->findAll();
				$assign["report"] = $rp;
				$assign["reportcateList"] = $rcList;
				// ナビゲーションバーの検索欄用
				$userDAO = new UserDAO($db);
				$assign["userList"] = $userDAO->findAll();
				$reportcateDAO = new ReportcateDAO($db);
				$assign["reportCateList"] = $reportcateDAO->findAll();
			}
		}
		return view($templatePath, $assign);
	}

	/**
	 * レポート編集処理
	 */
	public function edit(Request $request)
	{
		$templatePath = "report/edit";
		$isRedirect = false;
		$assign = [];
		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
			$rp = new Report();
			$rp->setId((int)$request->input("rpId"));
			$rp->setRpDate($request->input("rpDate"));
			$rp->setRpTimeFrom($request->input("rpTimeFrom").':00');	// MySQLのtime型(HH:MM:SS)に合わせる
			$rp->setRpTimeTo($request->input("rpTimeTo").':00');		// MySQLのtime型(HH:MM:SS)に合わせる
			$rp->setRpContent($request->input("rpContent"));
			$rp->setReportCateId((int)$request->input("reportCateId"));
			$rp->setUserId($request->session()->get('usId'));
			$db = DB::connection()->getPdo();

			// サーバ側バリデーション処理
			if (strtotime($rp->getRpTimeFrom()) > strtotime($rp->getRpTimeTo())) {
				$validationMsgs[] = "作業終了時刻が作業開始時刻以下のものが設定されています。正しい時刻を入力してください。";
			}
			if (empty($validationMsgs)) {
				$reportDAO = new ReportDAO($db);
				$result = $reportDAO->update($rp);
				if (empty($result)) {
					$assign["errorMsg"] = "レポート情報更新に失敗しました。もう一度はじめからやり直してください。";
					$templatePath = "error";
				}
				else {
					$isRedirect = true;
				}
			}
			else {
				// レポート編集画面に戻る
				$rp->setRpTimeFrom(substr($rp->getRpTimeFrom(), 0, -3));	// HTML上の時刻の形式(HH:MM)に合わせる
				$rp->setRpTimeTo(substr($rp->getRpTimeTo(), 0, -3));		// HTML上の時刻の形式(HH:MM)に合わせる
				// 全作業種類取得
				$reportcateDAO = new ReportcateDAO($db);
				$rcList = $reportcateDAO->findAll();
				$assign["report"] = $rp;
				$assign["reportcateList"] = $rcList;
				$assign["validationMsgs"] = $validationMsgs;
				// ナビゲーションバーの検索欄用
				$userDAO = new UserDAO($db);
				$assign["userList"] = $userDAO->findAll();
				$reportcateDAO = new ReportcateDAO($db);
				$assign["reportCateList"] = $reportcateDAO->findAll();
			}
		}
		if ($isRedirect) {
			$response = redirect("./reports/showList")->with("flashMsg", "レポートID:".$rp->getID()."でレポート情報を更新しました。");
		}
		else {
			$response = view($templatePath, $assign);
		}
		return $response;
	}

	/**
	 * レポート削除確認画面表示処理
	 */
	public function confirmDelete(int $rpId, Request $request)
	{
		$templatePath = "report/confirmDelete";
		$assign = [];
		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
			$db = DB::connection()->getPdo();
			// レポート情報
			$reportDAO = new ReportDAO($db);
			$rp = $reportDAO->findByRpId($rpId);
			$rp->setRpTimeFrom(substr($rp->getRpTimeFrom(), 0, -3));
			$rp->setRpTimeTo(substr($rp->getRpTimeTo(), 0, -3));
			$assign['report'] = $rp;
			// 作業種類情報
			$reportcateDAO = new ReportcateDAO($db);
			$rpcate = $reportcateDAO->findById($rp->getReportCateId());
			$assign['reportcate'] = $rpcate;
			// 投稿ユーザー情報
			$userDAO = new UserDAO($db);
			$us = $userDAO->findById($rp->getUserId());
			$assign['user'] = $us;
			// ナビゲーションバーの検索欄用
			$userDAO = new UserDAO($db);
			$assign["userList"] = $userDAO->findAll();
			$reportcateDAO = new ReportcateDAO($db);
			$assign["reportCateList"] = $reportcateDAO->findAll();
	}
		return view($templatePath, $assign);
	}

	/**
	 * レポート削除処理
	 */
	public function delete(Request $request)
	{
		$templatePath = "error";
		$isRedirect = false;
		$assign = [];
		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
			$rpId = (int)$request->input("deleteRpId");
			$db = DB::connection()->getPdo();
			$reportDAO = new ReportDAO($db);
			$result = $reportDAO->delete($rpId);
			if ($result) {
				$isRedirect = true;
			}
			else {
				$assign["errorMsg"] = "レポート情報削除に失敗しました。もう一度はじめからやり直してください。";
			}
		}
		if ($isRedirect) {
			$response = redirect("./reports/showList")->with("flashMsg", "レポートID:".$rpId."を削除しました。");
		}
		else {
			$response = view($templatePath, $assign);
		}
		return $response;
	}
}