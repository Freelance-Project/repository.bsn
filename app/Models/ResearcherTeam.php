<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Research;
use App\Models\Researcher;

class ResearcherTeam extends Model
{
    protected $table = 'researcher_teams';

    public $guarded = [];
    
    public function researcher()
    {
    	return $this->belongsTo(Researcher::class , 'researcher_id');
    }

    public function research()
    {
    	return $this->belongsTo(Research::class , 'other_id');
    }

}
