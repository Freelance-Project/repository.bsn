<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableArchiveRepos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_repos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->mediumText('intro')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('file')->nullable();
            $table->string('year')->nullable();
            $table->string('source')->nullable();
            $table->mediumText('info')->nullable();
            $table->integer('archive_content_id')->default(0);
            $table->integer('user_id')->default(0);
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
        Schema::drop('archive_repos');
    }
}
