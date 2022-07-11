<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'M-site',
            'P-site',
            'Q-site'
        ];
        foreach ($names as $name) {
            DB::table('sites')->insert([
                'name' => $name
            ]);
        }
    }
}
