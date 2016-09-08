<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldTujuanArchieveContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archive_contents', function (Blueprint $table) {
            $table->text('purpose')->after('description')->nullable();
            $table->text('recomendation')->after('purpose')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('archive_contents', function (Blueprint $table) {
            $table->dropColumn('purpose');
            $table->dropColumn('recomendation');
        });
    }
}
