<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldStatusInTableAdditionalData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('additional_datas', function (Blueprint $table) {
            $table->enum('status',['publish','unpublish'])->after('type')->default('unpublish');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('additional_datas', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
