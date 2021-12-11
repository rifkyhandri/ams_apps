<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssetStatus;
class AssetStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        AssetStatus::create([
            'id_statusasset'=>'Active',
            'description'=>'Active',
        ]);
    }
}
