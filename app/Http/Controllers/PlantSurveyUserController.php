<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PlantSurveyUser;
use Illuminate\Support\Facades\DB;

use function PHPSTORM_META\map;

class PlantSurveyUserController extends Controller
{

    public function show($survey_id, $participant_email)
    {
        $survey_plants = new PlantSurveyUser;
        $plants = $survey_plants->getPlantsBySurveyId($survey_id, $participant_email);
        if ($plants)
            return $plants;
            
        return response()->json([
            'message' => 'You are not authorized to access this survey',
            'code' => 401
        ], 401);
    }
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // Verifiy if user is part of the survey
        $survey = DB::table('survey_user')
        ->join('users', 'users.id', '=', 'survey_user.user_id')
        ->where('users.email', 'like', $request->participant_email)
        ->where('survey_user.survey_id', '=', $request->survey_id)
        ->select('survey_user.id','survey_user.survey_id','survey_user.user_id')
        ->first();
        if ($survey){
            $plant_survey = new PlantSurveyUser;
            // Clear plants for the survey for the user
            $plant_survey->deletePlantsBySurveyId($survey->survey_id, $survey->user_id);

            // Add plants
            $plant_survey->storePlantsBySurveyId($survey->survey_id, $survey->user_id, json_decode($request->plants));
            return response()->json([
                'message' => 'survey saved successfully',
                'code' => 200
            ], 200);
        }
        return response()->json([
            'message' => 'You are not authorized to save this survey',
            'code' => 401
        ], 401);
    }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, string $id)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(string $id)
    // {
    //     //
    // }
}
