<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = ['survey_id', 'botanical_name', 'family_name'];

    public function deleteSpeciesList($survey)
    {
        Plant::where('survey_id', $survey)->delete();

        return true;
    }

    /**
     * Get the users participating to that survey.
     */
    public function surveys(): BelongsToMany
    {
        return $this->belongsToMany(PlantSurveyUser::class);
    }
}
