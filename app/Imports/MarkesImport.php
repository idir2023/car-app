<?php

namespace App\Imports;

use App\Models\Marke;
use Maatwebsite\Excel\Concerns\ToModel;

class MarkesImport implements ToModel
{
    /**
     * Convert the row to a model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Marke([
            'name' => $row[0], // Assuming the first column is 'name'
            // Add other fields if needed, e.g., 'description' => $row[1], etc.
        ]);
    }
}
