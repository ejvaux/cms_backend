<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Local',
            'China'
        ];
        foreach ($names as $name) {
            DB::table('vendors')->insert([
                'name' => $name
            ]);
        }
    }
}
