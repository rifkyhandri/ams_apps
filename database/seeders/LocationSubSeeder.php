<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location_sub;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class LocationSubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idLocationSub = IdGenerator::generate(['table' => 'db_location_sub','field'=>'locationcode_sub', 'length' => 7, 'prefix' =>'LSU','reset_on_prefix_change'=>'true']);
        Location_sub::create([
            'locationcode_big'=> '1',
            'locationcode_sub'=> $idLocationSub,
            'locationname_sub'=>'Capital Place',
            'contact'=>'Bpk.Adhi',
            'address'=>'Jl.Gatot Subroto Capital Place',
            'city'=>'Jakarta',
            'postal'=>'12810',
            'phone'=>'02818281821',
            'OpeningDate'=> NOW(),
            'fax'=>'218821'
        ]);
    }
}
