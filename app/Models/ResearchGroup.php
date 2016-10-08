<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Research;

class ResearchGroup extends Model
{
    protected $table = 'research_groups';

    public $guarded = [];


    public function research()
    {
    	return $this->belongsTo(Research::class , 'other_id');
    }
}
