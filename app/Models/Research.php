<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AchiveRepo;

class ArchiveContent extends Model
{
    protected $table = 'archive_contents';

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

    		'title' => 'required|max:200|unique:archive_contents'.$plus,
			'intro' => 'max:300',
		];

		return $rules;
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User' , 'author_id');
    }
	
	public function repo()
    {
    	return $this->hasMany(AchiveRepo::class , 'archive_content_id');
    }
}
