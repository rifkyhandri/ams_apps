<?php

namespace App\Imports;

use App\Models\AssetStatus;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class AssetStatusImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return AssetStatus::firstOrCreate([
            'id_statusasset'=>$row['id_status_asset'],
            'description'=>$row['description'],
        ]);
    }
}
