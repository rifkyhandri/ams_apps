<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account_Group;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class AccountGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idAccountGroup = IdGenerator::generate(['table' => 'db_account_group','field'=>'id_account_group', 'length' => 7, 'prefix' =>'ACG','reset_on_prefix_change'=>'true']);
        Account_Group::create([
            'id_account_group' => $idAccountGroup,
            'account_group_name'=>'ASSET'
        ]);
    }
}
