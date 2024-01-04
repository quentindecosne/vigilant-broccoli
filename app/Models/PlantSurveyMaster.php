<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlantSurveyMaster extends Model
{
    use HasFactory;

    protected $table = 'plant_survey_master';

    protected $fillable = ['survey_id', 'plant_id', 'number_present', 'occurrence', 'regeneration', 'note'];
}
