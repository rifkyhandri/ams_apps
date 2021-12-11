<?php

namespace App\Imports;

use App\Models\AssetType;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class AssetTypeImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return AssetType::firstOrCreate([
            'id_typeasset'=>$row['id_type_asset'],
            'description'=>$row['description'],
        ]);
    }
}
