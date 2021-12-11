<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Provider;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class ServiceProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idProvider = IdGenerator::generate(['table' => 'db_provider','field'=>'providercode', 'length' => 6, 'prefix' =>'PVD']);
        Provider::create([
        'providercode'=>$idProvider,
        'providername'=>'PT.Telkom',
        'contact'=>'Bp.rusli',
        'address'=>'Jl.Gatot Subroto, Jakarta Selatan',
        'OpeningDate'=>'03-03-2020',
        'city'=>'Jakarta',
        'postal'=>'12810',
        'phone'=>'0218218821',
        'fax'=>'219219',
        ]);
    }
}
