<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValueCategoryInArticleContents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE article_contents CHANGE COLUMN category category ENUM('penelitian', 'publikasi', 'pendukung')");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE article_contents CHANGE COLUMN category category ENUM('penelitian', 'publikasi')");
    }
}
