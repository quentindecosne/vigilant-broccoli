<?php

namespace App\Models;

use App\Models\PlantSurveyUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'project_id'];


    /**
     * Get the project that owns the survey.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Get the users participating to that survey.
     */
    public function participants(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    
}
