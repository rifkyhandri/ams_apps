<?php

namespace App\Imports;

use App\Models\Custodian;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class CustodianImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Custodian::firstOrCreate([
        'custodiancode'=>$row['custodiancode'],
        'custodianname'=>$row['custodianname'],
        'contact'=>$row['contact'],
        'address'=>$row['address'],
        'OpeningDate'=>$row['openingdate'],
        'phone'=>$row['phone'],
        'city'=>$row['city'],
        'postal'=>$row['postal'],
        'fax'=>$row['fax'],
        'telex'=>$row['telex'],
        'email'=>$row['email'],
        'usertype'=>$row['usertype'],
        'company'=>$row['company'],
        'status'=>$row['status'],
      
        ]);
    }
}
