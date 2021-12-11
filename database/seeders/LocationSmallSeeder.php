<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location_sm;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class LocationSmallSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idLocationSm = IdGenerator::generate(['table' => 'db_location_sm','field'=>'locationcode_sm', 'length' => 7, 'prefix' =>'LSM','reset_on_prefix_change'=>'true']);
        Location_sm::create([
            'locationcode_big'=> '1',
            'locationcode_sub'=> '1',
            'locationcode_sm'=>$idLocationSm,
            'locationname_sm'=>'Ruang Meeting',
            'contact'=>'Bpk.Imam',
            'address_sm'=>'Lantai 12',
            'phone'=>'082818218218',
            'OpeningDate'=> NOW()
        ]);
    }
}
