<?php

namespace App\Imports;

use App\Models\AccountChart;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
class AccountChartImport implements ToModel,WithHeadingRow,WithChunkReading,WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        // $rowIndex = $row->getIndex();
        // $row      = $row->toArray();

     $group = AccountChart::firstOrCreate(
        [
        'accountno'=>$row['account_no'],
        'accountname'=>$row['account_name'],
        'accountshortname'=>$row['account_short_name'],
        'accountgroup'=>$row['account_group'],
        'oldaccount'=>$row['old_account'],
        'subgroup'=>$row['subs_group'],
        'level'=>$row['level'],
        'status'=>$row['status']
        ],
    );
    
    }
  
    public function batchSize(): int
    {
        return 1000;
    }
    
    public function chunkSize(): int
    {
        return 1000; //ANGKA TERSEBUT PERTANDA JUMLAH BARIS YANG AKAN DIEKSEKUSI
    }
    
}
