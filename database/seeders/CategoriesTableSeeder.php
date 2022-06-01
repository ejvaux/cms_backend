<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'Indirect Materials',
            'Auto Screwing'
        ];
        foreach ($names as $name) {
            DB::table('categories')->insert([
                'name' => $name
            ]);
        }
    }
}
