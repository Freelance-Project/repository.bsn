<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetDefaultValueResearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('researches', function (Blueprint $table) {
            // $table->string('title')->nullable()->change();
            // $table->text('summary')->nullable()->change();
            // $table->text('intro')->nullable()->change();
            // $table->text('background')->nullable()->change();
            // $table->text('goal')->nullable()->change();
            // $table->text('conclusion')->nullable()->change();
            // $table->text('recommendation')->nullable()->change();
            // $table->text('recommendation_target')->nullable()->change();
            // $table->string('location')->nullable()->change();
            // $table->string('file')->nullable()->change();
            // $table->string('year')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('researches', function (Blueprint $table) {
            //
        });
    }
}
