<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAdditionalDatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('additional_datas', function (Blueprint $table) {
        
            $table->increments('id');
            $table->string('title');
            $table->string('year');
            $table->string('file');
            $table->enum('availability',['softcopy','hardcopy']);
            $table->string('format');
            $table->integer('other_id')->default(0);
            $table->enum('type',['penelitian','publikasi']);
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
        Schema::drop('additional_datas');
    }
}
