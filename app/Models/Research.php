<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ArticleContent;
use App\Models\ResearchGroup;

class Research extends Model
{
    protected $table = 'researches';

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

    		'title' => 'required|max:200|unique:research_groups'.$plus,
			'intro' => 'max:300',
		];

		return $rules;
    }
	*/

	public function acticlecontent()
    {
		return $this->belongsTo(ActicleContent::class, 'article_content_id');
    }
	
	public function researchgroup()
    {
    	return $this->hasMany(ResearchGroup::class , 'other_id');
    }
}
