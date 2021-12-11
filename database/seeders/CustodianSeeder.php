<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Custodian;
class CustodianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Custodian::create([
            'custodiancode'=>'CST001',
            'custodianname'=>'Rifky Handri',
            'contact'=>'087717777618',
            'address'=>'Jl.Tebet barat raya , Gg.trijaya IV RT.012 RW.007 No.40, Jakarta Selatan',
            'OpeningDate'=>'07-02-2019',
            'phone'=>'087717777618',
            'city'=>'Jakarta',
            'postal'=>'12810',
            'fax'=>'210201',
            'telex'=>'219912',
            'cloud_id'=>'-',
            'email'=>'rifky.febrian04@gmail.com',
            'usertype'=>'Programmer',
            'company'=>'Wahana Datarindo Sempurna',
            'tree_id'=>'1020201',
            'status'=>'Actived',
        ]);
    }
}
