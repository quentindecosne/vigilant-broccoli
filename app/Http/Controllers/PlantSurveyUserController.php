<?php

namespace App\Http\Controllers;

use App\Models\PlantSurveyUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlantSurveyUserController extends Controller
{
    public function show($survey_id, $participant_email)
    {
        $survey_plants = new PlantSurveyUser;
        $plants = $survey_plants->getPlantsBySurveyId($survey_id, $participant_email);
        if ($plants) {
            return $plants;
        }

        return response()->json([
            'message' => 'You are not authorized to access this survey',
            'code' => 401,
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
        $user = User::where('email', 'like', $request->participant_email)->first();
        $survey = DB::table('survey_user')
            ->join('surveys', 'surveys.id', '=', 'survey_user.survey_id')
            ->where('survey_user.user_id', '=', $user->id)
            ->where('survey_user.survey_id', '=', $request->survey_id)
            ->select('survey_user.id', 'survey_user.survey_id', 'survey_user.user_id', 'surveys.name')
            ->first();

        if ($survey) {
            $plant_survey = new PlantSurveyUser;
            $completed_at = $plant_survey->storePlantsBySurveyId($survey, $user, json_decode($request->plants), $request->surveyed_at);
            if ($completed_at) {
                return response()->json([
                    'message' => 'survey saved successfully',
                    'code' => 200,
                    'data' => ['completed_at' => $completed_at],
                ], 200);
            } else {
                return response()->json([
                    'message' => 'error while saving the survey',
                    'code' => 500,
                ], 500);
            }
        }

        return response()->json([
            'message' => 'You are not authorized to save this survey',
            'code' => 401,
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
