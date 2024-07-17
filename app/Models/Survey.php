<?php

namespace App\Models;

use App\Imports\PlantsImport;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Survey extends Model
{
    protected $fillable = ['name', 'project_id', 'species_list', 'surveyed_at', 'completed_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'surveyed_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    public function importSpeciesList($survey, $file)
    {
        if (PlantSurveyMaster::where('survey_id', $survey->id)->exists()) {
            return 'Import failed: A species list already exists for this survey.';
        }
        Plant::deleteSpeciesList($survey->id);
        $import = new PlantsImport;
        $import->import($file);

        return true;
    }

    /**
     * Get the project that owns the survey.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the users participating in that survey.
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->withPivot('completed_at', 'surveyed_at');
    }
}
