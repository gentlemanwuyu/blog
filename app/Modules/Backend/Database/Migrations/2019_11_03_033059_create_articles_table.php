<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articles', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title')->default('')->comment('标题');
			$table->string('keywords', 1024)->default('')->comment('关键词');
			$table->text('content')->default('')->comment('内容');
			$table->string('summary', 1024)->default('')->comment('摘要');
			$table->integer('summary_image_id')->default(0)->comment('摘要图片ID');
			$table->string('summary_image_url', 1024)->default('')->comment('摘要图片url');
			$table->string('summary_image_desc')->default('')->comment('摘要图片描述');
			$table->integer('category_id')->default(0)->comment('分类ID');
			$table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('创建时间');
			$table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->comment('最后更新时间');
			$table->timestamp('deleted_at')->nullable()->comment('删除时间');
			$table->index('title');
			$table->index('category_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('articles');
	}
}
