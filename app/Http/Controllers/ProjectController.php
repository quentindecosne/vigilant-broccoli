<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\PlantSurveyUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('project.index');
    }

    public function show(Project $project)
    {        
        $submitted_surveys = [];
        $proj = Project::get()->first();
        foreach($proj->surveys as $survey){
            foreach($survey->participants as $participant){
                $is_submitted = PlantSurveyUser::where('survey_id', '=', $survey->id)->where('user_id', '=', $participant->id)->count();
                if ($is_submitted)
                    $submitted_surveys[] += $participant->id;
            }
        }
        return view('project.show', ['project'=> $proj, 'submitted_surveys' => $submitted_surveys]);
    }

}
