<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'contact', 'address', 'email', 'phone'];

    /**
     * Get the surveys for the project.
     */
    public function surveys(): HasMany
    {
        return $this->hasMany(Survey::class);
    }
}
