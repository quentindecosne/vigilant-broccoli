<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function download($surveyId)
    {

        $survey = Survey::find($surveyId);

        if (Storage::exists('public')) {
            return Storage::download($survey->species_list, $survey->name.'.csv');
        } else {
            return redirect()->back()->with('error', 'File not found.');
        }
    }
}
