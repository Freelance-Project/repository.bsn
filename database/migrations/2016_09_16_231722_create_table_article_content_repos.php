<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticleContentRepos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_content_repos', function (Blueprint $table) {
        
            $table->increments('id');
            $table->integer('article_content_id')->unsigned();
			$table->string('title');
            $table->text('intro');
            $table->text('description');
            $table->string('file');
            $table->integer('views');
            $table->enum('status',['publish','unpublish'])->default('publish');
            $table->timestamps();
			
			$table->foreign('article_content_id')->references('id')->on('article_contents')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('article_content_repos');
    }
}
