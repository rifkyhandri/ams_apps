<?php

namespace App\Imports;

use App\Models\CostCenter;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class CostCenterImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       return CostCenter::firstOrCreate([
        'costcentercode'=>$row['cost_center_code'],
        'costcenterdesc'=>$row['description'],
        'coa'=>$row['coa'],
        
       ]);
    }
}
