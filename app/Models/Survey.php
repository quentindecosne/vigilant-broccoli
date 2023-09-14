<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
}
