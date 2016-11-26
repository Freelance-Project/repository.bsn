<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Research;
// use Illuminate\Database\Eloquent\SoftDeletes;

class ResearchLocation extends Model
{
    // use SoftDeletes;
    protected $table = 'research_locations';

    public $guarded = [];

	public function research()
    {
		return $this->belongsTo(Research::class, 'research_id');
    }
	
}
