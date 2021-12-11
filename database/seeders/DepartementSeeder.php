<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Departement;
class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departement::create([
            'departementcode'=>'GA',
            'departementdesc'=>'General Affairs'
        ]);
    }
}
