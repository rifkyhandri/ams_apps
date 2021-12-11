<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ownership;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class OwnershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idOwnership = IdGenerator::generate(['table' => 'db_ownership','field'=>'id_ownership', 'length' => 6, 'prefix' =>'OWN','reset_on_prefix_change'=>'true']);
        Ownership::create([
            'id_ownership'=>$idOwnership,
            'description'=>'Dana Indonesia',
        ]);
    }
}
