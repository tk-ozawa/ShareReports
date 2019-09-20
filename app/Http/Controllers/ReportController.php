<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Functions;
use App\DAO\ReportDAO;

/**
 * レポート管理に関するコントローラクラス
 */
class ReportController extends Controller
{
	/**
	 * レポート一覧画面表示処理
	 */
	public function showList(Request $request)
	{
		$templatePath = "report/reportList";
		$assign = [];
		if (Functions::loginCheck($request)) {
			$validationMsgs[] = "ログインしていないか、前回ログインしてから一定時間が経過しています。もう一度ログインしなおしてください。";
			$assign["validationMsgs"] = $validationMsgs;
			$templatePath = "login";
		}
		else {
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


}
