<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('visitors', function (Blueprint $table) {
			$table->increments('id');
			$table->string('ip', 1024)->default('')->comment('ip地址');
			$table->string('url', 1024)->default('')->comment('url');
			$table->string('referer')->default('')->comment('referer');
			$table->string('device')->default('')->comment('设备');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('visitors');
	}
}
