<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AllocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'ALL MODELS',
            'ARUBA',
            'AUTO SCREWING',
            'BRAVO',
            'DIP/EULER',
            'FIXTURE',
            'IMPROVEMENT',
            'MATTHEW',
            'PROJECT 6',
            'PSITE',
            'SUPERPOD',
            'TECHNICIAN',
            'TG4482',
            'TG4483',
            'TG4484',
            'TG4485',
            'TS REPAIR',
            'NOT USED'
        ];
        foreach ($names as $name) {
            DB::table('allocations')->insert([
                'name' => $name
            ]);
        }
    }
}
