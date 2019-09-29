<?php
/**
 * アカウント登録
 */
Route::post("/prepareRegister", "RegistrationController@prepareRegister");	// アカウント登録画面表示処理
Route::post("/confirmRegister", "RegistrationController@confirmRegister");	// アカウント登録情報確認画面表示処理
Route::post("/completeRegister", "RegistrationController@register");	// アカウント仮登録情報確認画面表示処理
Route::get("/applyRegistration/{token}", "RegistrationController@apply");	// アカウント本登録完了画面表示処理


/**
 * アカウントログイン
 */
Route::get("/", "LoginController@goLogin");	// ログイン画面表示処理
Route::post("/login", "LoginController@login");	// ログイン処理
Route::get("/logout", "LoginController@logout");	// ログアウト処理


/**
 * レポート管理
 */
Route::get("/reports/showList", "ReportController@showList");	// レポートリスト表示処理
Route::get("/reports/searchList", "ReportController@searchList");	// レポート検索結果表示処理

Route::get("/reports/goAdd", "ReportController@goAdd");	// レポート登録画面表示処理
Route::post("/reports/add", "ReportController@add");	// レポート登録処理

Route::get("/reports/detail/{rpId}", "ReportController@showDetail");	// レポート詳細画面表示処理

Route::get("/reports/prepareEdit/{rpId}", "ReportController@prepareEdit");	// レポート編集画面表示処理
Route::post("reports/edit", "ReportController@edit");	// レポート編集処理

Route::get("/reports/confirmDelete/{rpId}", "ReportController@confirmDelete");	// レポート削除確認画面表示処理
Route::post("/reports/delete", "ReportController@delete");	// レポート削除処理

/**
 * Ajax
 */
Route::get("/reports/Ajax/rcListByUsId", "ReportController@rcListByUsIdAjax");