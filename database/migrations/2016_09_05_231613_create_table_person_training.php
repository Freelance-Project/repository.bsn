<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePersonTraining extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_trainings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('person_id')->unsigned();
            $table->string('name');
            $table->date('start_date');
            $table->date('end_date');
            $table->text('description');
            $table->string('organizer');
            $table->enum('certificate',['yes','no'])->default('no');
            $table->enum('type',['training','workshop'])->default('training');
            $table->timestamps();

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
        Schema::drop('person_trainings');
    }
}
