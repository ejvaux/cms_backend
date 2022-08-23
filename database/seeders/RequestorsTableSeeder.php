<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
            [
                'emp' => 'WAREHOUSE',
                'name' => 'Warehouse'
            ],
            //[
            //    'emp' => 'D000001',
            //    'name' => 'John Doe'
            //],
            //[
            //    'emp' => 'D000002',
            //    'name' => 'Juan Dela Cruz'
            //]
        ];
        foreach ($names as $name) {
            DB::table('requestors')->insert([
                'employee_number' => $name['emp'],
                'name' => $name['name'],
                'code' => md5($name['emp'])
            ]);
        }
    }
}
