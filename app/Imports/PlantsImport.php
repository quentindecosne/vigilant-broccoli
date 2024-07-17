<?php

namespace App\Imports;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class PlantsImport implements ToModel
{
    public $survey_id;

    public function __construct($survey_id)
    {
        $this->survey_id = $survey_id ?? null;
    }

    /**
     * @return Model|null
     */
    public function model(array $row)
    {
        if (! isset($row[0])) {
            return null;
        }

        return new Plant([
            'survey_id' => $this->survey_id,
            'botanical_name' => $row[1],
        ]);
    }
}
