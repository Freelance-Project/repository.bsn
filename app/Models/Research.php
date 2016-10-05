<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\ArticleContent;
use App\Models\ResearchGroup;
use App\Models\ActicleContent;
use Illuminate\Database\Eloquent\SoftDeletes;

class Research extends Model
{
    use SoftDeletes;
    protected $table = 'researches';

    public $guarded = [];

	public function article()
    {
		return $this->belongsTo(ActicleContent::class, 'article_content_id');
    }
	
	public function researchgroup()
    {
    	return $this->hasMany(ResearchGroup::class , 'other_id');
    }
}
