<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = ['botanical_name', 'family_name'];

    /**
     * Get the users participating to that survey.
     */
    public function surveys(): BelongsToMany
    {
        return $this->belongsToMany(PlantSurveyUser::class);
    }


}
