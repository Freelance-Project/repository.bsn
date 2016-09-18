<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArticleContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_contents', function (Blueprint $table) {
        
            $table->increments('id');
            $table->string('slug');
            $table->string('title');
            $table->text('intro');
            $table->text('description');
            $table->string('image');
            $table->enum('category',['penelitian','publikasi'])->default('penelitian');
            $table->integer('author_id')->unsigned();
            $table->string('year');
            $table->integer('views');
            $table->enum('status',['publish','unpublish'])->default('publish');
            $table->timestamps();
            
            $table->foreign('author_id')->references('id')->on('users')
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
        Schema::drop('article_contents');
    }
}
