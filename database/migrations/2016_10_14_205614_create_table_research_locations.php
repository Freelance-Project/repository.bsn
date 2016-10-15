<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResearchLocations extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_locations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('research_id')->unsigned();;
            $table->string('location');
            $table->timestamps();

            $table->foreign('research_id')->references('id')->on('researches')
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
        Schema::drop('research_locations');
    }
}
