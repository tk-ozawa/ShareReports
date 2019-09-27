<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportcatesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reportcates', function (Blueprint $table) {
			$table->bigIncrements("id"		)->comment("作業種類ID");
			$table->string("rc_name"		)->comment("種類名");
			$table->string("rc_note"		)->nullable()->default(null)->comment("備考");
			$table->integer("rc_list_flg"	)->default(1)->comment("リスト表示の有無: 0=非表示, 1=表示");
			$table->integer("rc_order"		)->default(0)->comment("表示順序");
			// $table->timestamps();			// created_at と updated_at カラムの作成
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('reportcates');
	}
}
