<?php

use Illuminate\Support\Facades\Schema;
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
			$table->string('title')->comment('文章标题');
			$table->text('content')->comment('文章内容');
			$table->unsignedInteger('category_id')->comment('分类ID');
			$table->unsignedInteger('author_id')->comment('作者ID');
			$table->unsignedInteger('status')->comment('文章状态');
			$table->unsignedInteger('view_count')->default(0)->comment('浏览次数');
			$table->enum('is_original', ['1', '0'])->default('0')->comment('是否原创');
			$table->string('article_image')->nullable()->comment('文章图片');
			$table->string('slug')->nullable()->comment('SEO关键字');
			$table->timestamp('published_at')->nullable()->comment('发布时间');
            $table->timestamps();
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
