<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Pnuematic',
            'Spare',
            'Test Spare'
        ];
        foreach ($names as $name) {
            DB::table('item_types')->insert([
                'name' => $name
            ]);
        }
    }
}
