<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResearchDatas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_datas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('additional_data_id')->unsigned();
            $table->integer('other_id')->default(0);
            $table->timestamps();

            $table->foreign('additional_data_id')->references('id')->on('additional_datas')
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
        Schema::drop('research_datas');
    }
}
