<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Mail\RegisterShipped;
use Mail;

use App\Entity\User;
use App\DAO\UserDAO;

class RegistrationController extends Controller
{
	/**
	 * アカウント登録画面表示処理
	 */
	public function prepareRegister(Request $request)
	{
		$templatePath = "prepareRegistration";
		$user = new User();
		if (!empty($request->input('registUsMail'))) {
			$user->setUsMail($request->input('registUsMail'));
		}
		if (!empty($request->input('registUsName'))) {
			$user->setUsName($request->input('registUsName'));
		}
		if (!empty($request->input('registUsPasswd'))) {
			$user->setUsPassword($request->input('registUsPasswd'));
		}
		$assign["user"] = $user;
		return view($templatePath, $assign);
	}

	/**
	 * アカウント登録情報確認画面表示処理
	 */
	public function confirmRegister(Request $request)
	{
		$templatePath = "confirmRegistration";
		$assign = [];
		$validationMsgs = [];

		$user = new User();
		$user->setUsMail($request->input('registUsMail'));
		$user->setUsName($request->input('registUsName'));
		$user->setUsPassword($request->input('registUsPasswd'));
		$db = DB::connection()->getPdo();
		// バリデーション
		$userDAO = new UserDAO($db);
		$dbUser = $userDAO->findByUsMail($request->input('registUsMail'));
		if (!empty($dbUser)) {
			$validationMsgs[] = "登録済みのメールアドレスです。別のメールアドレスを登録するか、ログインしてください。";
			$user->setUsMail('');	// メールアドレス欄を初期化
			$templatePath = "prepareRegistration";
			$assign["validationMsgs"] = $validationMsgs;
		}
		$assign["user"] = $user;
		return view($templatePath, $assign);
	}

	/**
	 * アカウント登録処理 / アカウント登録完了画面表示処理
	 */
	public function register(Request $request)
	{
		$templatePath = "completeRegistration";
		$assign = [];
		$user = new User();
		$user->setUsMail($request->input('registUsMail'));
		$user->setUsName($request->input('registUsName'));
		$user->setUsPassword($request->input('registUsPasswd'));
		$db = DB::connection()->getPdo();
		// ユーザー登録処理
		$userDAO = new UserDAO($db);
		$rpId = $userDAO->insert($user);
		if ($rpId === -1) {
			$assign["errorMsg"] = "ユーザー情報登録に失敗しました。もう一度はじめからやり直してください。";
			$templatePath = "error";
		}
		else {
			// us_mail_vertify_token
			$assign["user"] = $user;
			// メール送信
			Mail::to($user->getUsMail())->send(new RegisterShipped($user));
		}
		return view($templatePath, $assign);
	}
}