<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('item_groups')->insert([
            'name' => 'Consumables',
        ]);
        DB::table('item_groups')->insert([
            'name' => 'Spare parts',
        ]);
    }
}
