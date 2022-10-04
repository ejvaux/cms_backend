<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'OK',
            'FOR ORDER',
            'CRITICAL',
        ];
        foreach ($names as $name) {
            DB::table('item_statuses')->insert([
                'name' => $name
            ]);
        }
    }
}
