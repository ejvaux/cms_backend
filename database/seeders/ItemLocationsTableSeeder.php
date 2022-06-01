<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemLocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            '1-D',
            '2-E',
            '2-H',
            '2-I',
            '2-J',
            '2-K',
            '2-L',
            '3-E',
            '3-F',
            '3-G',
            '3-I',
            '3-K',
            'A-1',
            'A-2',
            'A-3',
            'A-4',
            'A-5',
            'A-6',
            'A-7',
            'A-8',
            'B-1',
            'B-2',
            'B-3',
            'B-4',
            'B-5',
            'B-6',
            'B-7',
            'B-8',
            'C-1',
            'C-2',
            'C-4',
            'C-5',
            'C-6',
            'C-7',
            'C-8',
            'CA-1',
            'CA-10',
            'CA-2',
            'CA-3',
            'CA-4',
            'CA-5',
            'CA-6',
            'CA-7',
            'CA-8',
            'CA-9',
            'D-4',
            'D-5',
            'D-6',
            'D-8',
            'E-3',
            'E-5',
            'OFFICE',
            'RACK 3',
            'RACK C',
        ];
        foreach ($names as $name) {
            DB::table('item_locations')->insert([
                'name' => $name
            ]);
        }
    }
}
