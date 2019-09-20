<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
	/**
	 * ログイン画面出力
	 */
	public function goLogin()
	{
		return view("login");
	}


	/**
	 * 
	 */

}