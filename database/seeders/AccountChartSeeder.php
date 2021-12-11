<?php

namespace Database\Seeders;
use App\Models\AccountChart;
use Illuminate\Database\Seeder;

class AccountChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        AccountChart::create([
            'accountno' => '120210120',
            'accountname' => 'Bank Checking Account',
            'accountshortname' => 'BCA',
            'accountgroup' => 'Current Assets',
            'oldaccount' =>'Bank Central Asia',
            'subgroup' => 'Payment',
            'level' =>2,
            'status' =>'Actived',
        ]);
    }
}
