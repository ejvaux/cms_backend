<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class WorkflowLevelTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'PROCESS',
            'STATE',
            'OUTCOME',
            'QUALIFIER'
        ];
        foreach ($names as $name) {
            DB::table('workflow_level_type')->insert([
                'type_key' => $name
            ]);
        }
    }
}
