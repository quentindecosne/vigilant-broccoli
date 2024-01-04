<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

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

        if (! $plants_list->isEmpty()) {
            foreach ($plants_list as $plant) {
                $names = explode(' ', strtolower($plant->botanical_name));
                $arr['plant_id'] = $plant->id;
                $arr['plant_genus'] = $names[0];
                $arr['plant_species'] = $names[1];
                $arr['number_present'] = $plant->number_present ? $plant->number_present : 0;
                $arr['occurrence'] = $plant->occurrence ? $plant->occurrence : '';
                $arr['regeneration'] = $plant->regeneration ? $plant->regeneration : '';
                $arr['note'] = $plant->note ? $plant->note : '';
                $plants = Arr::prepend($plants, $arr);
            }
        } else {
            $plants_list = DB::table('plants')->get();
            foreach ($plants_list as $plant) {
                $names = explode(' ', strtolower($plant->botanical_name));
                $arr['plant_id'] = $plant->id;
                $arr['plant_genus'] = $names[0];
                $arr['plant_species'] = $names[1];
                $arr['number_present'] = 0;
                $arr['occurrence'] = '';
                $arr['regeneration'] = '';
                $arr['note'] = '';
                $plants = Arr::prepend($plants, $arr);
            }
        }

        return json_encode($plants);
    }

    public function storePlantsBySurveyId($survey, $user, $plants, $surveyed_at)
    {
        $this->deletePlantsBySurveyId($survey->id, $user->id);
        $completed_at = Carbon::now();
        DB::table('survey_user')
            ->where('id', '=', $survey->survey_id)
            ->update(['surveyed_at' => $surveyed_at, 'completed_at' => $completed_at]);

        activity('recent')->by($user)->event('success')
            ->withProperties(['survey' => $survey->name, 'survey_id' => $survey->survey_id])
            ->log(':causer.name has submitted their survey: :properties.survey');

        foreach ($plants as $plant) {
            PlantSurveyUser::create([
                'survey_id' => $survey->survey_id,
                'user_id' => $user->id,
                'plant_id' => $plant->plant_id,
                'number_present' => $plant->number_present,
                'occurrence' => $plant->occurrence,
                'regeneration' => $plant->regeneration,
                'note' => $plant->note,
            ]);
            $master_survey_plant = PlantSurveyMaster::where('survey_id', '=', $survey->survey_id)
                ->where('plant_id', '=', $plant->plant_id)
                ->first();
            if (! $master_survey_plant) {
                PlantSurveyMaster::create([
                    'survey_id' => $survey->survey_id,
                    'plant_id' => $plant->plant_id,
                    'number_present' => $plant->number_present,
                    'occurrence' => $plant->occurrence,
                    'regeneration' => $plant->regeneration,
                    'note' => $plant->note,
                ]);
            } else {
                if ($master_survey_plant->occurrence != $plant->occurrence) {
                    $master_survey_plant->occurrence = null;
                }
                if ($master_survey_plant->regeneration != $plant->regeneration) {
                    $master_survey_plant->regeneration = null;
                }
                $master_survey_plant->update();
            }
        }

        return $completed_at;
    }

    public function deletePlantsBySurveyId($id, $user_id)
    {
        return PlantSurveyUser::where('survey_id', '=', $id)->where('user_id', '=', $user_id)->delete();
    }
}
