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
	// コンストラクタインジェクション (newすることなくUserクラスのメソッドを呼び出せるようにする)
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	/**
	 * アカウント登録画面表示処理
	 */
	public function prepareRegister(Request $request)
	{
		if (!empty($registUsMail = $request->input('registUsMail'))) {
			$this->user->setUsMail($registUsMail);
		}
		if (!empty($registUsName = $request->input('registUsName'))) {
			$this->user->setUsName($registUsName);
		}
		if (!empty($registUsPasswd = $request->input('registUsPasswd'))) {
			$this->user->setUsPassword($registUsPasswd);
		}
		$assign["user"] = $this->user;
		return view("prepareRegistration", $assign);
	}

	/**
	 * アカウント登録情報確認画面表示処理
	 */
	public function confirmRegister(Request $request)
	{
		$templatePath = "confirmRegistration";
		$assign = [];

		$this->user->setUsMail($request->input('registUsMail'));
		$this->user->setUsName($request->input('registUsName'));
		$this->user->setUsPassword($request->input('registUsPasswd'));
		$db = DB::connection()->getPdo();
		// バリデーション
		$userDAO = new UserDAO($db);
		$dbUser = $userDAO->findByUsMail($request->input('registUsMail'));
		if (!empty($dbUser)) {
			// 入力画面に戻る
			$this->user->setUsMail('');	// メールアドレス欄を初期化
			$assign["validationMsgs"] = "登録済みのメールアドレスです。別のメールアドレスを登録するか、ログインしてください。";
			$templatePath = "prepareRegistration";
		}
		$assign["user"] = $this->user;
		return view($templatePath, $assign);
	}

	/**
	 * アカウント仮登録処理 / アカウント仮登録完了画面表示処理
	 */
	public function register(Request $request)
	{
		$templatePath = "completeRegistration";
		$assign = [];
		$this->user->setUsMail($request->input('registUsMail'));
		$this->user->setUsName($request->input('registUsName'));
		$this->user->setUsPassword($request->input('registUsPasswd'));
		$this->user->setUsMailVerifyToken(md5(uniqid().$this->user->getUsMail().$this->user->getUsName()));
		$db = DB::connection()->getPdo();
		// ユーザー登録処理
		$userDAO = new UserDAO($db);
		$rpId = $userDAO->insert($this->user);
		if ($rpId === -1) {
			$assign["errorMsg"] = "ユーザー情報登録に失敗しました。もう一度はじめからやり直してください。";
			$templatePath = "error";
		}
		else {
			$assign["user"] = $this->user;
			// メール送信
			Mail::to($this->user->getUsMail())->send(new RegisterShipped($this->user));
		}
		return view($templatePath, $assign);
	}

	/**
	 * アカウント本登録処理 / アカウント本登録完了画面表示処理
	 */
	public function apply(string $token, Request $request)
	{
		$templatePath = "error";
		$assign = [];
		$db = DB::connection()->getPdo();
		// ユーザー登録処理
		$userDAO = new UserDAO($db);
		$user = $userDAO->findByUsMailVerifyToken($token);
		if (empty($user)) {
			$assign["errorMsg"] = "無効なトークンです。";
		}
		else {
			if ($userDAO->updateUsAuth($user)) {	// us_authを2に
				$assign["user"] = $user;
				$templatePath = "applyRegistration";
			}
			else {
				$assign["errorMsg"] = "アカウント本登録処理に失敗しました。";
			}
		}
		return view($templatePath, $assign);
	}
}