<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'John Doe',
            'Juan Dela Cruz'
        ];
        foreach ($names as $name) {
            DB::table('requestors')->insert([
                'name' => $name
            ]);
        }
    }
}
