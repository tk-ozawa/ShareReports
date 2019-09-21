<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Functions;
use App\DAO\ReportDAO;
use App\DAO\ReportcateDAO;

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
		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
			// 作業日欄用に、現在の年月日を取得
			$assign['today'] = ['year' => date("Y"), 'month' => date("n"), 'day' => date("j")];

			// reportcatesテーブルの全情報を取得
			$db = DB::connection()->getPdo();
			$reportcateDAO = new ReportcateDAO($db);
			$assign['reportcateList'] = $reportcateDAO->findAll();
		}
		return view($templatePath, $assign);


	}
}
