<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldUserIdInArchiveContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('archive_contents', function (Blueprint $table) {
            $table->integer('user_id')->after('custom_text')->default(0);
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
            $table->dropColumn('user_id');
        });
    }
}
