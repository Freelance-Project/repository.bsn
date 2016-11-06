<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AdditionalData;

class ResearchData extends Model
{
    protected $table = 'research_datas';

    public $guarded = [];


    public function additional()
    {
    	return $this->belongsTo(AdditionalData::class, 'additional_data_id');
    }
}
