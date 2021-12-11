<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Condition;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class ConditionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Condition = IdGenerator::generate(['table' => 'db_condition','field'=>'conditioncode', 'length' => 6, 'prefix' =>'CDT','reset_on_prefix_change'=>'true']);
        Condition::create([
            'conditioncode' => $Condition,
            'conditiondesc' => 'Goods'
        ]);
    }
}
