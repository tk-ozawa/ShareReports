<?php
/**
 * ログイン
 */
Route::get("/", "LoginController@goLogin");
Route::post("/login", "LoginController@login");