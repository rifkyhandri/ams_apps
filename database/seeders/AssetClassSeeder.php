<?php

namespace Database\Seeders;
use App\Models\AssetClass;
use Illuminate\Database\Seeder;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class AssetClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id_assetclass = IdGenerator::generate(['table' => 'db_assetclass','field'=>'classcode', 'length' => 7, 'prefix' =>'ACT','reset_on_prefix_change'=>'true']);
        AssetClass::create([
            'classcode'=>$id_assetclass,
            'classdesc'=>'PILLOW',
        ]);
       
    }
}
