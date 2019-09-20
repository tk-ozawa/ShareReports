<?php
/**
 * ログイン
 */
Route::get("/", "LoginController@goLogin");	// ログイン画面表示処理
Route::post("/login", "LoginController@login");	// ログイン処理
Route::get("/logout", "LoginController@logout");	// ログアウト処理

/**
 * レポート管理
 */
Route::get("/reports/showList", "ReportController@showList");	// レポート一覧表示処理
