<?php

namespace App\Http\Controllers;

use App\Models\PlantSurveyMaster;
use Illuminate\Http\Request;

class PlantSurveyMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PlantSurveyMaster $plantSurveyMaster)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PlantSurveyMaster $plantSurveyMaster)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PlantSurveyMaster $plantSurveyMaster)
    {
        $master_survey_plant = PlantSurveyMaster::find($request->master_id);
        if ($master_survey_plant){
            if ($request->type == "occurrence"){
                if ($master_survey_plant->occurrence != $request->selected_value)
                    $master_survey_plant->occurrence = $request->selected_value;
                    $master_survey_plant->save();
            }
            if ($request->type == "regeneration"){
                if ($master_survey_plant->regeneration != $request->selected_value)
                    $master_survey_plant->regeneration = $request->selected_value;
                    $master_survey_plant->save();
            }
        }
        return response()->json(['master_survey_plant' => $master_survey_plant ]);


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PlantSurveyMaster $plantSurveyMaster)
    {
        //
    }
}
