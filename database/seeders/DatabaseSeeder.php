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
            UnitsTableSeeder::class,
            VendorsTableSeeder::class,
            DepartmentsTableSeeder::class,
            SitesTableSeeder::class,
            RequestorsTableSeeder::class,
            WorkflowLevelTypeTableSeeder::class,
            WorkflowStateTypeTableSeeder::class,
            WorkflowStateHierarchyTableSeeder::class,
            WorkflowStateContextTableSeeder::class,
            WorkflowStateOptionTableSeeder::class,
            WorkflowStateRoleTableSeeder::class,
            StockUpdateSettingsTableSeeder::class,
            ItemGroupTableSeeder::class,
        ]);
    }
}
