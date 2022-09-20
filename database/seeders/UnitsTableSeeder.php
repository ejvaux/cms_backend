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
        $units = [
            [
                'name' => 'ML',
                'description' => 'Mililiter'
            ],
            [
                'name' => 'PAIRS',
                'description' => 'Pairs'
            ],
            [
                'name' => 'PCS',
                'description' => 'Pieces'
            ],
            [
                'name' => 'ROLLS',
                'description' => 'Rolls'
            ],
            [
                'name' => 'METERS',
                'description' => 'Meters'
            ]
        ];
        foreach ($units as $unit) {
            DB::table('units')->insert([
                'name' => $unit['name'],
                'description' => $unit['description']
            ]);
        }
    }
}
