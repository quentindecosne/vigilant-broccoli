<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getByUserEmail($email)
    {
        $user = User::where('email', $email)->first();

        if (! $user) {
            return response()->json([
                'message' => 'user email not recognized',
                'code' => 401,
            ], 401);
        }

        $surveys = $user->surveys()->with('project')->get();
        foreach ($surveys as $item) {
            $survey['id'] = $item['id'];
            $survey['name'] = $item['name'];
            $survey['project'] = $item['project']['name'];
            $survey['address'] = $item['project']['address'];
            $survey['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $item['created_at'])->format('Y-m-d');
            $survey['surveyed_at'] = $item['pivot']['surveyed_at'] ? Carbon::createFromFormat('Y-m-d H:i:s', $item['pivot']['surveyed_at'])->format('Y-m-d') : '';
            $survey['completed_at'] = $item['pivot']['completed_at'] ? Carbon::createFromFormat('Y-m-d H:i:s', $item['pivot']['completed_at'])->format('Y-m-d') : '';
            $user_surveys[] = $survey;
        }

        return response()->json(['surveys' => $user_surveys], 200);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
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
    public function show(User $user)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
