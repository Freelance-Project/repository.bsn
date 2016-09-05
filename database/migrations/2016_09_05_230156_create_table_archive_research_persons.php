<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArchiveResearchPersons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_research_persons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('archive_content_id')->unsigned();
            $table->integer('person_id')->unsigned();
            $table->timestamps();

            $table->foreign('archive_content_id')->references('id')->on('archive_contents')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('person_id')->references('id')->on('persons')
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
        Schema::drop('archive_research_persons');
    }
}
