<?php

namespace App\Imports;

use App\Models\Ownership;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class OwnershipImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Ownership::firstOrCreate([
            'id_ownership'=>$row['id_ownership'],
            'description'=>$row['description'],
        ]);
    }
}
