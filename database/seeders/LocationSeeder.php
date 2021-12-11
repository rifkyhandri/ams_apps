<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idLocationBig = IdGenerator::generate(['table' => 'db_location','field'=>'locationcode', 'length' => 7, 'prefix' =>'LCT','reset_on_prefix_change'=>'true']);
        Location::create([
            'locationcode'=>$idLocationBig,
            'locationname'=>'Jakarta',
            'country'=>'Indonesia',
        ]);
    }
}
