<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PlantSurveyUser extends Model
{
    use HasFactory;


    public function getPlantsBySurveyId($id, $user_email)
    {
        $plants = [];
        $plants_list = DB::table('plant_survey_user')
        ->join('plants', 'plants.id', '=', 'plant_survey_user.plant_id')
        ->join('users', 'users.id', '=', 'plant_survey_user.user_id')
        ->select('plant_survey_user.id', 'plants.botanical_name', 'plant_survey_user.number_present', 'plant_survey_user.occurrence', 'plant_survey_user.regeneration', 'plant_survey_user.note')
        ->where('users.email', 'like', $user_email)
        ->where('plant_survey_user.survey_id', '=', $id)
        ->get();

        foreach ($plants_list as $plant){
            $names = explode(" ", strtolower($plant->botanical_name));
            $plants[]['plant_id'] = $plant->id;
            $plants[]['plant_genus'] = $names[0];
            $plants[]['plant_species'] = $names[1];
            $plants[]['number_present'] = $plant->number_present ? $plant->number_present : 0;
            $plants[]['occurrence'] = $plant->occurrence ? $plant->occurrence : '';
            $plants[]['regeneration'] = $plant->regeneration ? $plant->regeneration : '';;
            $plants[]['note'] = $plant->note ? $plant->note : '';;

        }
        return $plants;
    }

    // /**
    //  * Get the surveys with this plant.
    //  */
    // public function surveys(): BelongsToMany
    // {
    //     return $this->belongsToMany(Survey::class);
    // }

    // /**
    //  * Get the surveys for the project.
    //  */
    // public function plants(): HasMany
    // {
    //     return $this->hasMany(Plant::class);
    // }
}
