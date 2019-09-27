<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reports', function (Blueprint $table) {
			$table->increments('id'			)->comment("レポートID");
			$table->date("rp_date"			)->comment("作業日"); 
			$table->time("rp_time_from"		)->comment("作業開始時間");
			$table->time("rp_time_to"		)->comment("作業終了時間");
			$table->string("rp_content"		)->comment("作業内容");
			$table->datetime("rp_created_at")->comment("登録日時");
			$table->integer("reportcate_id"	)->comment("作業種類ID");
			$table->integer("user_id"		)->comment("報告者ID");
			// $table->timestamps();			// created_at と updated_at カラムの作成

			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('reportcate_id')->references('id')->on('reportcates');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('reports');
	}
}
