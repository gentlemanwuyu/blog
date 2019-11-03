<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleLabelsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('article_labels', function (Blueprint $table) {
			$table->integer('article_id')->default(0)->comment('文章ID');
			$table->integer('label_id')->default(0)->comment('标签ID');
			$table->index('article_id');
			$table->index('label_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('article_labels');
	}
}
