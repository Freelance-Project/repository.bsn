<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArchiveResearches extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_researches', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('archive_content_id')->unsigned();
            $table->integer('research_group_id')->unsigned();
            $table->timestamps();

            $table->foreign('archive_content_id')->references('id')->on('archive_contents')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table->foreign('research_group_id')->references('id')->on('research_groups')
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
        Schema::drop('archive_researches');
    }
}
