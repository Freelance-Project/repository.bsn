<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ArticleContent;

class Publication extends Model
{
	use SoftDeletes;
    protected $table = 'publications';

    public $guarded = [];

    public function article()
    {
		return $this->belongsTo(ArticleContent::class, 'article_content_id');
    }
    
}
