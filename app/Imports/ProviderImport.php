<?php

namespace App\Imports;

use App\Models\Provider;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class ProviderImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return Provider::firstOrCreate([
            'providercode'=>$row['provider_code'],
            'providername'=>$row['provider_name'],
            'contact'=>$row['contact'],
            'address'=>$row['address'],
            'OpeningDate'=>$row['opening_date'],
            'city'=>$row['city'],
            'postal'=>$row['postal'],
            'phone'=>$row['phone'],
            'fax'=>$row['fax'],
        ]);
    }
}
