<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldCategoryArchiveContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archive_contents', function (Blueprint $table) {
            $table->enum('category', ['penelitian','publikasi'])->after('year')->default('penelitian');
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
            $table->dropColumn('category');
        });
    }
}
