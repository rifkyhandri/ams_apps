<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vendor;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idVendor = IdGenerator::generate(['table' => 'db_vendor','field'=>'vendorcode', 'length' => 6, 'prefix' =>'VEN']);
        Vendor::create([
            'vendorcode'=>$idVendor,
            'vendorname'=>'Catepilar',
            'account'=>'BCA',
            'OpeningDate'=>'20-20-2019',
            'address'=>'Menteng Jakarta Pusat',
            'city'=>'Jakarta Pusat',
            'postal'=>'21002',
            'phone'=>'029129912o9',
            'fax'=>'210201',
            'telex'=>'219291',
            'status'=>'actived',
            'pic'=>'Jamaludin',
            'pic_phone'=>'0218882181',
            'pic_email'=>'jamaludiansyah@gmail.com',
        ]);
    }
}
