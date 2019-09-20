<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\DAO\UserDAO;

class LoginController extends Controller
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
		$assign = [];
		$validationMsgs = [];

		// POSTの取得
		$loginUsMail = trim($request->input("loginUsMail"));
		$loginPw = trim($request->input("loginUsPasswd"));

		// DB接続 & DAO読み込み
		$db = DB::connection()->getPdo();
		$UserDAO = new UserDAO($db);

		// ログイン判定
		$user = $UserDAO->findByUsEmail($loginUsMail, $loginPw);
		if ($user === null) {
			$validationMsgs[] = "登録されていないメールアドレスです。正しいメールアドレスを入力するか、アカウントを作成してください。";
		}
		else {
			$userPw = $user->getUsPassword();
			if (password_verify($loginPw, $userPw)) {	// 第1引数をpassword_hash()した上で比較する
				// ログイン成功
				$session = $request->session();
				$session->put("loginFlg", true);
				$session->put("usId", $user->getId());
				$session->put("usName", $user->getUsName());
				$session->put("auth", 1);
				$isRedirect = true;
			}
			else {
				// ログイン失敗
				$validationMsgs[] = "パスワードが違います。正しいパスワードを入力してください。";
			}
		}

		if ($isRedirect) {
			// ログイン成功
			$response = redirect("/reports/showList");
		}
		else {
			// ログイン失敗
			$assign["validationMsgs"] = $validationMsgs;
			$assign["loginUsMail"] = $loginUsMail;
			$response = view("login", $assign);
		}

		return $response;
	}

	/**
	 * ログアウト処理
	 */
	public function logout(Request $request)
	{
		// session削除
		$session = $request->session();
		$session->flush();
		$session->regenerate();

		return redirect("/");
	}
}