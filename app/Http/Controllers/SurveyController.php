<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Support\Facades\DB;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('survey.index');
    }

    public function show(Survey $survey)
    {
        $survey_results = [];
        $survey = Survey::find($survey->id);
        $results = DB::table('plant_survey_user')
            ->join('users', 'users.id', '=', 'plant_survey_user.user_id')
            ->leftJoin('plants', 'plants.id', '=', 'plant_survey_user.plant_id')
            ->where('plant_survey_user.survey_id', '=', $survey->id)
            ->orderBy('users.id', 'asc')
            ->select([
                'plants.family_name',
                'plants.botanical_name',
                'users.name as participant',
                'plant_survey_user.id as id',
                'plant_survey_user.user_id as participant',
                'plant_survey_user.plant_id as plant_id',
                'plant_survey_user.number_present as number_present',
                'plant_survey_user.occurrence as occurrence',
                'plant_survey_user.regeneration as regeneration',
            ])->get();

        foreach ($results as $result) {
            $survey_results[$result->plant_id]['id'] = $result->id;
            $survey_results[$result->plant_id]['botanical_name'] = $result->botanical_name;
            $survey_results[$result->plant_id]['family_name'] = $result->family_name;
            $survey_results[$result->plant_id]['number_present'][$result->participant] = $result->number_present;
            $survey_results[$result->plant_id]['occurrence'][$result->participant] = $result->occurrence;
            $survey_results[$result->plant_id]['regeneration'][$result->participant] = $result->regeneration;
        }

        return view('survey.show', ['survey' => $survey, 'survey_results' => $survey_results]);
    }
}
