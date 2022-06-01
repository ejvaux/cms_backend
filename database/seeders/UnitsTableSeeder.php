<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'ML',
            'PAIRS',
            'PCS',
            'ROLLS',
            'METERS'
        ];
        foreach ($names as $name) {
            DB::table('units')->insert([
                'name' => $name
            ]);
        }
    }
}
