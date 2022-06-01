<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShiftsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shifts')->insert([
            'name' => 'DAYSHIFT',
            'initial' => 'DS'
        ]);
        DB::table('shifts')->insert([
            'name' => 'NIGHTSHIFT',
            'initial' => 'NS'
        ]);
    }
}
