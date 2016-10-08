<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldWriterResearchTeams extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('researcher_teams', function (Blueprint $table) {
            $table->string('writer')->after('functional');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('researcher_teams', function (Blueprint $table) {
            $table->dropColumn('writer');
        });
    }
}
