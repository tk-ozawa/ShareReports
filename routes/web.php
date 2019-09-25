<?php
/**
 * アカウント登録
 */
Route::get("/register", "RegistrationController@prepareRegister");
Route::post("/confirmRegister", "RegistrationController@confirmRegister");

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