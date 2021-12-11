<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AssetType;
class AssetTypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        AssetType::create([
            'id_typeasset'=>'ASSET',
            'description'=>'ASSET',
            'tree_id'=>'-',
            'cloud_id'=>'-',
        ]);
    }
}
