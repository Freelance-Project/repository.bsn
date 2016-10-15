<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableInterestGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researcher_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('researcher_id')->unsigned();
            $table->integer('interest_group_id')->unsigned();
            $table->timestamps();

            $table->foreign('researcher_id')->references('id')->on('researchers')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('interest_group_id')->references('id')->on('interest_groups')
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
        Schema::drop('researcher_areas');
    }
}
