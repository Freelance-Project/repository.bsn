<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Research;

class ResearchGroup extends Model
{
    protected $table = 'research_groups';

    public $guarded = [];


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

	public function research()
    {
    	return $this->hasMany(ResearchGroup::class , 'other_id');
    }
}
