<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'FATP',
            'SMT',
            'DIP'
        ];
        foreach ($names as $name) {
            DB::table('departments')->insert([
                'name' => $name
            ]);
        }
    }
}
