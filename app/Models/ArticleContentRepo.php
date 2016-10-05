<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ArticleContent;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArchiveContent extends Model
{
    use SoftDeletes;
    protected $table = 'article_content_repos';

    public $guarded = [];


    public function user()
    {
    	return $this->belongsTo('App\Models\User' , 'author_id');
    }
	
	public function article()
    {
    	return $this->belongsTo(ArticleContent::class , 'article_content_id');
    }
}
