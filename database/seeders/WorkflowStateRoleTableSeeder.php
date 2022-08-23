<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class WorkflowStateRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PROCESS
        $kups = [
            "1",
            "2",
            "4",
        ];
        foreach ($kups as $kup) {
            DB::table('workflow_state_role')->insert([
                'role' => "Common",
                'level_type_id' => "1",
                'state_type_id' => $kup
            ]);
        }

        $kups = [
            "1",
            "2",
            "3",
            "4",
        ];
        foreach ($kups as $kup) {
            DB::table('workflow_state_role')->insert([
                'role' => "Approver",
                'level_type_id' => "1",
                'state_type_id' => $kup
            ]);
        }

        $kups = [
            "1",
            "2",
            "3",
            "4",
        ];
        foreach ($kups as $kup) {
            DB::table('workflow_state_role')->insert([
                'role' => "Personnel",
                'level_type_id' => "1",
                'state_type_id' => $kup
            ]);
        }

        // STATES
        $kups = [
            "5",
            "10",
            "15",
        ];
        foreach ($kups as $kup) {
            DB::table('workflow_state_role')->insert([
                'role' => "Common",
                'level_type_id' => "2",
                'state_type_id' => $kup
            ]);
        }

        $kups = [
            "6",
            "11",
            "14",
            "15",
        ];
        foreach ($kups as $kup) {
            DB::table('workflow_state_role')->insert([
                'role' => "Approver",
                'level_type_id' => "2",
                'state_type_id' => $kup
            ]);
        }

        $kups = [
            "7",
            "8",
            "9",
            "12",
            "13",
            "15",
        ];
        foreach ($kups as $kup) {
            DB::table('workflow_state_role')->insert([
                'role' => "Personnel",
                'level_type_id' => "2",
                'state_type_id' => $kup
            ]);
        }
    }
}
