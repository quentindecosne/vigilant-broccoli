<?php

namespace App\Http\Controllers;

use App\Models\PlantSurveyUser;
use App\Models\Project;

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
        $proj = Project::find($project->id);
        foreach ($proj->surveys as $survey) {
            foreach ($survey->participants as $participant) {
                $is_submitted = PlantSurveyUser::where('survey_id', '=', $survey->id)->where('user_id', '=', $participant->id)->count();
                if ($is_submitted) {
                    $submitted_surveys[] += $participant->id;
                }
            }
        }

        return view('project.show', ['project' => $proj, 'submitted_surveys' => $submitted_surveys]);
    }
}
