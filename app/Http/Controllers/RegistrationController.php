<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use App\DAO\UserDAO;

class RegistrationController extends Controller
{
	/**
	 * アカウント登録画面表示処理
	 */
	public function prepareRegister(Request $request)
	{
		return view("prepareRegistration");
	}

	/**
	 * アカウント登録情報確認画面表示処理
	 */
	public function confirmRegister(Request $request)
	{
		$templatePath = "confirmRegistration";
	}
}