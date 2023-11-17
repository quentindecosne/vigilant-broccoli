<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UserController extends Controller
{


    public function getByUserEmail($email)
    {
        $surveys = [];
        $user = User::with(['surveys', 'surveys.project'])->where('email', 'like', $email)->get()->first();
        if (!$user)
            return response()->json([
            'message' => 'user email not recognized',
            'code' => 401
        ], 401);

        foreach($user->surveys as $item){
            $survey['id'] = $item['id'];
            $survey['name'] = $item['name'];
            $survey['project'] = $item['project']['name'];
            $survey['address'] = $item['project']['address'];
            $survey['created_at'] = Carbon::createFromFormat('Y-m-d H:i:s', $item['created_at'])->format('Y-m-d');
            $surveys[] = $survey;
        }
        echo json_encode($surveys);
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
