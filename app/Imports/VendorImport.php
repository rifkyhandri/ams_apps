<?php

namespace App\Imports;

use App\Models\Vendor;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VendorImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    
    public function model(array $row)
    {
       
        return Vendor::firstOrCreate([
            
            'vendorcode' => $row['vendor_code'],
            'vendorname' => $row['vendor_name'],
            'account' => $row['account'],
            'address' =>$row['address'],
            'city' =>$row['city'],
            'postal' =>$row['postal'],
            'phone'=>$row['phone'],
            'fax'=>$row['fax'],
            'status'=>$row['status'],
            'pic'=>$row['pic'],
            'pic_phone'=>$row['pic_phone'],
            'pic_email'=>$row['pic_email'],
         
        ]);
    }
    public function chunkSize(): int
    {
        return 1000;
    }
  

}
