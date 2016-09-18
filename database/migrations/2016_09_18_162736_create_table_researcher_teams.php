<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableResearcherTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('researcher_teams', function (Blueprint $table) {
        
            $table->increments('id');
            $table->integer('researcher_id')->unsigned();
            $table->enum('position',['ketua','wakil','anggota','sekretariat','lainnya']);
            $table->enum('functional',['p_utama','p_madya','p_muda','p_pertama','non_p']);
            $table->string('instance');
            $table->enum('interest_category',['kp','mek','ppk','ls']);
            $table->string('expert_category');
            $table->enum('type',['penelitian','publikasi'])->default('penelitian');
            $table->integer('other_id')->default(0);
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
        Schema::drop('researcher_teams');
    }
}
