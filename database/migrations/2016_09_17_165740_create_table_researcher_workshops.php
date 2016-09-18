<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResearcherWorkshops extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researcher_workshops', function (Blueprint $table) {
        
            $table->increments('id');
			$table->string('name');
			$table->date('time');
			$table->string('organizer');
			$table->enum('sertificate',['y','t']);
			$table->enum('type',['training','seminar']);
			$table->integer('researcher_id')->unsigned();
            $table->timestamps();
			
			$table->foreign('researcher_id')->references('id')->on('researchers')
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
        Schema::drop('researcher_workshops');
    }
}
