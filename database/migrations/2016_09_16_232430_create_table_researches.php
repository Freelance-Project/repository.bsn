<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResearches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researches', function (Blueprint $table) {
        
            $table->increments('id');
            $table->integer('article_content_id')->unsigned();
            $table->text('summary');
            $table->text('intro');
            $table->text('background');
            $table->text('goal');
            $table->text('conclusion');
            $table->text('recommendation');
            $table->text('recommendation_target');
            $table->string('location');
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
        Schema::drop('researches');
    }
}
