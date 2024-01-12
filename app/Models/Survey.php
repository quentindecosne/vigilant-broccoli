<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Survey extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'project_id', 'surveyed_at', 'completed_at'];

    protected $casts = [
        'created_at' => 'datetime',
        'surveyed_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

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
