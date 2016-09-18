<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResearchGroups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_groups', function (Blueprint $table) {
        
            $table->increments('id');
            $table->enum('name',['kp','mek','ppk','ls']);
            $table->enum('type',['penelitian','publikasi']);
            $table->integer('other_id')->default(0);
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
        Schema::drop('research_groups');
    }
}
