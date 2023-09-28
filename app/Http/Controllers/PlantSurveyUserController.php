<?php

namespace App\Http\Controllers;

use App\Models\PlantSurveyUser;
use Illuminate\Http\Request;

class PlantSurveyUserController extends Controller
{

    public function show($survey_id, $participant_email)
    {
        $plants = new PlantSurveyUser; 
        return $plants->getPlantsBySurveyId($survey_id, $participant_email);
    }
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

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
