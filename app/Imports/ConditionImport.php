<?php

namespace App\Imports;

use App\Models\Condition;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ConditionImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Condition::firstOrCreate([
        'conditioncode'=>$row['condition_code'],
        'conditiondesc'=>$row['description'],
        ]);
    }
}
