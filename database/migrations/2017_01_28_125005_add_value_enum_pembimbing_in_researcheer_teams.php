<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValueEnumPembimbingInResearcheerTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE researcher_teams CHANGE COLUMN position position ENUM('ketua','wakil','anggota','sekretariat','pembimbing','lainnya')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE researcher_teams CHANGE COLUMN position position ENUM('ketua','wakil','anggota','sekretariat','lainnya')");
    }
}
