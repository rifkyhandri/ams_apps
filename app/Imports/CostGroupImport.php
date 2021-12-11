<?php

namespace App\Imports;

use App\Models\CostGroup;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class CostGroupImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return CostGroup::firstOrCreate([
        'groupcode'=>$row['groupcode'],
        'groupname'=>$row['groupname'],
        'bookvalrate'=>$row['bookvalrate'],
        'life'=>$row['life'],
        'Ledger1'=>$row['ledger1'],
        'Ledger2'=>$row['ledger2'],
        'Ledger3'=>$row['ledger3'],
        'Ledger4'=>$row['ledger4'],
        'Ledger5'=>$row['ledger5'],
        'Ledger6'=>$row['ledger6'],
        'Ledger7'=>$row['ledger7'],
        'bookdeptrate'=>$row['bookdeptrate'],
        'taxdepreciation'=>$row['taxdepreciation'],
       
        ]);
    }
}
