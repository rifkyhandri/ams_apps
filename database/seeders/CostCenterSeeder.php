<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CostCenter;
class CostCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CostCenter::create([
            'costcentercode'=>'FNTR',
            'costcenterdesc'=>'Furniture',
            'costcenterdesc'=>'Furniture',
        ]);
    }
}
