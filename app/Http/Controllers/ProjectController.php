<?php

namespace App\Http\Controllers;

use App\Models\Project;
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
        return view('projects.index');
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
    public function store(StoreProjectRequest $request)
    {
        Project::create($request->validated());
        // notify()->success('Project created!');
        return redirect('/projects');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        return True;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        return True;
      //  $user = Auth::user();
        // if ($user->can('delete projects')){
            
        //     // $count = Survey::where('project_id', $id)->count();

        //     // if ($count > 0)
        //     //     return redirect(route('projects'))->with('error', trans("this project has surveys"));

        //     Project::destroy($project);
        //     return redirect(route('projects'))->with('success', trans('app.record_deleted', ['field' => 'project']));
        // }
        // return abort(403, trans('error.unauthorized'));
    }
}
