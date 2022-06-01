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
        // \App\Models\User::factory(10)->create();
        $this->call([
            AllocationsTableSeeder::class,
            CategoriesTableSeeder::class,
            ItemLocationsTableSeeder::class,


            ItemTypesTableSeeder::class,
            LocationsTableSeeder::class,
            ShiftsTableSeeder::class,


            StationsTableSeeder::class,
            TransactionTypesTableSeeder::class,
            UnitsTableSeeder::class,

            VendorsTableSeeder::class,
        ]);
    }
}
