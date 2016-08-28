<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArchiveContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_contents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('title');
            $table->mediumText('intro')->nullable();
            $table->mediumText('summary')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->integer('person_id')->default(0);
            $table->string('year')->nullable();
            $table->enum('category', ['buku','jurnal','penelitian','paper','majalah'])->default('buku');
            $table->integer('type')->default(0);
            $table->text('custom_text');
            $table->integer('view')->default(0);
            $table->integer('read')->default(0);
            $table->integer('download')->default(0);
            $table->integer('share')->default(0);
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
        Schema::drop('archive_contents');
    }
}
