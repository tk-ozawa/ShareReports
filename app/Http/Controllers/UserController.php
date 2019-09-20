<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\Entity\User;
use App\DAO\UserDAO;

class UserController extends Controller
{
	/**
	 * ログイン画面出力処理
	 */
	public function goLogin()
	{
		return view("login");
	}

	/**
	 * ログイン処理
	 */
	public function login(Request $request)
	{
		$isRedirect = false;
		$templatePath = "login";
		$assign = [];

		// POSTの取得
		$loginEmail = trim($request->input("loginEmail"));
		$loginPassword = trim($request->input("loginPassword"));

		// DB接続 & DAO読み込み
		$db = DB::connection()->getPdo();
		$UserDAO = new UserDAO($db);

		// ログイン判定
		$userId = $UserDAO->login($loginEmail, $loginPassword);
		if($userId < 0) {	// メールアドレスが未登録
			$assign['errorMsg'] = "ログイン失敗:アカウントが登録されていません";
		}
		else if($userId === 0) {	// パスワードが不一致
			$assign['errorMsg'] = "ログイン失敗:パスワードが違います";
		}
		else {	// ログイン成功
			$isRedirect = true;
		}

		if($isRedirect) {	// ログイン成功
			$response = redirect("/reports/showList");
			$request->session()->put('userId', $userId);
		}
		else {	// ログイン失敗
			$response = view($templatePath, $assign);
		}

		return $response;
	}

}