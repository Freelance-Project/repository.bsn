<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ActicleContentRepo;
use App\Models\Research;
use Illuminate\Database\Eloquent\SoftDeletes;

class ArticleContent extends Model
{
    use SoftDeletes;
    
    protected $table = 'article_contents';

    public $guarded = [];

	public function user()
    {
    	return $this->belongsTo('App\Models\User' , 'author_id');
    }
	
	public function repo()
    {
    	return $this->hasMany(ActicleContentRepo::class , 'article_content_id');
    }
	
	public function research()
	{
		return $this->hasOne(Research::class, 'article_content_id');
	}
}
