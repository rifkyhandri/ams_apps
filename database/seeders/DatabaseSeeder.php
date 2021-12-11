<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(100)->create();
        $this->call([
            UserSeeder::class,
            AccountGroupSeeder::class,
            AccountGroupSubSeeder::class,
            AccountChartSeeder::class,
            AssetClassSeeder::class,
            AssetStatusSeeder::class,
            ConditionSeeder::class,
            CostCenterSeeder::class,
            CostGroupSeeder::class,
            DepartementSeeder::class,
            LocationSeeder::class,
            LocationSubSeeder::class,
            LocationSmallSeeder::class,
            OwnershipSeeder::class,
            ServiceProviderSeeder::class,
            VendorSeeder::class,
            RegisterAssetSeeder::class
	    ]);
    }
}
