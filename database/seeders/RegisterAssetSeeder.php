<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asset;
class RegisterAssetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Asset::create([
            'old_tagnumber'=>'012005.0003',
            "tangnumber"=>'210021021',
            "assetname"=>'Software Aktuaria VIP Financial (K2005-10-143)',
            "asset_type"=>'INV',
            "models"=>'Chair',
            "notes"=>'Meeting Chair',
            "assetclass"=>'ACT0001',
            "custodian"=>'CST002',
            "assetgroup"=>'MTC',
            "costcenter"=>'FNTR',
            "asCondition"=>'CDT001',
            "location"=>'LSM0001',
            "departement"=>'GA',
            "vendors"=>'VEN001',
            'account'=>'100',
            "payment"=>'PO1221212',
            "serial"=>'12921921',
            "datepurchase"=>'2021-02-26',
            "dateacq"=>'2021-02-07',
            "purchasecost"=>'4000000',
            "purchaseacq"=>'4000000',
            "lifetimeyear"=>'3',
            "livetimemonth"=>'2',
            "comdepreciation"=>'Non depreciable',
            "fiscaldepreciation"=>'Non depreciable',
            "salvage1"=>'5',
            "bookrate"=>'5',
            "serviceprovider"=>'PVD001',
            "nextservice"=>'2021-04-05',
            "warranty"=>'-',
            "servicecontract"=>'No Service',
            "tagged"=>'-',
            "brand"=>'-',
            "manufacture"=>'-',
            "partnumber"=>'-',
            "ownership"=>'-',
            "ESN"=>'-',
            "IP"=>'-',
            "asstatus"=>'-',
            "gps_lat"=>'-6.2707835',
            "gps_long"=>'106.8216752',
        ]);
    }
}
