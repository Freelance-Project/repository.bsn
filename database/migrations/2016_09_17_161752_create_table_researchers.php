<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResearchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researchers', function (Blueprint $table) {
        
            $table->increments('id');
			$table->string('name');
			$table->string('birthplace');
			$table->date('dob');
			$table->enum('position',['p_utama','p_madya','p_muda','p_pertama','non_p']);
            $table->string('grade');
            $table->string('interest_category');
            $table->string('expert_category');
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->string('education');
            $table->string('experience');
            $table->enum('status',['active','not_active'])->default('active');
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
        Schema::drop('researchers');
    }
}
