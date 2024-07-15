<?php

namespace App\Imports;

use App\Models\Plant;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;

class PlantsImport implements ToModel
{
    /**
     * @return Model|null
     */
    public function model(array $row)
    {
        return new Plant([
            'botanical_name' => $row[1],
        ]);
    }
}
