<?php

use App\Http\Controllers\PlantSurveyMasterController;
use Illuminate\Support\Facades\Route;
use Spatie\Activitylog\Models\Activity;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    } else {
        return view('auth.login'); // You can also use 'auth.register' if you want to direct to the registration page.
    }
});

Route::get('/dashboard', function () {
    $activity = Activity::inLog('recent')->with('causer')->orderBy('created_at','desc')->limit(10)->get();
    return view('dashboard', ['activity' => $activity]);
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('projects', ProjectController::class);
    Route::resource('surveys', SurveyController::class);
    Route::resource('plants', PlantController::class);

    Route::post('/master-survey/{master_id}', [PlantSurveyMasterController::class, 'update'])->name('master-survey.update');
});

require __DIR__.'/auth.php';
