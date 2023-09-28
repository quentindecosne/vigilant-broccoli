<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PlantSurveyUserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/user/{user_email}', [UserController::class, 'getByUserEmail']);
Route::get('/survey-plants/{survey_id}/{participant_email}', [PlantSurveyUserController::class, 'show']);
Route::post('/survey-plants', [PlantSurveyUserController::class, 'store']);