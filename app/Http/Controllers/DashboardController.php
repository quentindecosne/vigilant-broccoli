<?php

namespace App\Http\Controllers;

use App\Models\Plant;
use App\Models\Project;
use App\Models\Survey;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::count();
        $surveys = Survey::count();
        $plants = Plant::count();
        $activity = Activity::inLog('recent')->with('causer')->orderBy('created_at','desc')->limit(10)->get();
        return view('dashboard', ['activity' => $activity, 'projects' => $projects, 'surveys' => $surveys, 'plants' => $plants]);
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
