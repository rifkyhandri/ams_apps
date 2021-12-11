<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account_Sub;
use Haruncpi\LaravelIdGenerator\IdGenerator;
class AccountGroupSubSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $idAccountSub = IdGenerator::generate(['table' => 'db_account_sub','field'=>'id_db_account_group', 'length' => 7, 'prefix' =>'ACS','reset_on_prefix_change'=>'true']);
        Account_Sub::create([
            'id_db_account_group' => 'ACG0001',
            'id_account_sub' =>$idAccountSub,
            'account_sub_name' =>'Bangunan',
        ]);
    }
}
