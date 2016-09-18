<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePublications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publications', function (Blueprint $table) {
        
            $table->increments('id');
            $table->integer('article_content_id')->unsigned();
            $table->enum('category',['jurnal','prosiding','lainnya']);
            $table->string('volume');
            $table->text('abstract');
            $table->text('conclusion');
            $table->text('recommendation');
            $table->string('file');
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
        Schema::drop('publications');
    }
}
