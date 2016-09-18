<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ActicleContentRepo;
use App\Models\Research;

class ArticleContent extends Model
{
    protected $table = 'article_contents';

    public $guarded = [];

	/*
    public function rules($id = "")
    {

    	if(!empty($id))
    	{
    		$plus = ',title,'.$id;
    	
    	}else{
    	
    		$plus = '';
    	
    	}

    	$rules = [

    		'title' => 'required|max:200|unique:article_contents'.$plus,
			'intro' => 'max:300',
		];

		return $rules;
    }
	*/

    public function user()
    {
    	return $this->belongsTo('App\Models\User' , 'author_id');
    }
	
	public function repo()
    {
    	return $this->hasMany(ActicleContentRepo::class , 'archive_content_id');
    }
	
	public function research()
	{
		return $this->belongsTo(Research::class, 'article_content_id');
	}
}
