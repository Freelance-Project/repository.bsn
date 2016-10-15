<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\InterestGroup;
use App\Models\Researcher;

class ResearcherArea extends Model
{
    protected $table = 'researcher_areas';

    public $guarded = [];

    public function researcher()
    {
    	return $this->belongsTo(Researcher::class , 'researcher_id');
    }

    public function interest()
    {
    	return $this->belongsTo(InterestGroup::class , 'interest_group_id');
    }
}
