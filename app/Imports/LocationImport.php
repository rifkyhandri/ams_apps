<?php

namespace App\Imports;

use App\Models\Location;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class LocationImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Location::firstOrCreate([
            'locationcode'=>$row['location_code'],
            'locationname'=>$row['city'],
            'city'=>$row['country'],
          
        ]);
    }
}
