<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()	// マイグレーション実行時に呼び出される関数
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments("id"						)->comment("ユーザーID");
			$table->string("us_mail"					)->comment("メールアドレス");
			$table->string("us_name"					)->comment("ユーザー名");
			$table->string("us_password"				)->comment("パスワード");
			$table->string("us_mail_verify_token", 255	)->comment("メール認証用トークン");
			$table->integer("us_auth"					)->default(2)->comment("ユーザー権限:0=無効, 1=管理者, 2=一般");
			// $table->timestamps();			// created_at と updated_at カラムの作成
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()	// ロールバック時に呼び出される関数
	{
		Schema::dropIfExists('users');
	}
}
