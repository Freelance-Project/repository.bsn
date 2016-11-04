<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResearchStandard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('research_standards', function (Blueprint $table) {
            
			$table->increments('id');
            $table->enum('name',['standardisasi','kesesuaian','snsu']);
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
        Schema::drop('research_standards');
    }
}
