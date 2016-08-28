<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldStatusInArchiveContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archive_contents', function (Blueprint $table) {
            $table->enum('status', ['publish','unpublish'])->after('share')->default('publish');
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
            $table->dropColumn('status');
        });
    }
}
