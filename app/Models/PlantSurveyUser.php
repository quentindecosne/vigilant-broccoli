<?php

namespace App\Models;

use App\Models\Survey;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlantSurveyUser extends Model
{
    use HasFactory;

    protected $table = 'plant_survey_user';
    protected $fillable = ['survey_id', 'user_id', 'plant_id', 'number_present', 'occurrence', 'regeneration', 'note'];


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
            $arr['plant_id'] = $plant->id;
            $arr['plant_genus'] = $names[0];
            $arr['plant_species'] = $names[1];
            $arr['number_present'] = $plant->number_present ? $plant->number_present : 0;
            $arr['occurrence'] = $plant->occurrence ? $plant->occurrence : '';
            $arr['regeneration'] = $plant->regeneration ? $plant->regeneration : '';;
            $arr['note'] = $plant->note ? $plant->note : '';;
            $plants = Arr::prepend($plants, $arr);
        }
        return $plants;
    }

    public function storePlantsBySurveyId($survey_id, $user_id, $plants)
    {
        foreach($plants as $plant){
            PlantSurveyUser::create([
                'survey_id' => $survey_id,
                'user_id' => $user_id,
                'plant_id' => $plant->plant_id,
                'number_present' => $plant->number_present,
                'occurrence' => $plant->occurrence,
                'regeneration' => $plant->regeneration,
                'note' => $plant->note,
            ]);
        }
    }


    public function deletePlantsBySurveyId($id, $user_id)
    {
        return PlantSurveyUser::where('survey_id', '=', $id)->where('user_id', '=', $user_id)->delete();
    }

}
