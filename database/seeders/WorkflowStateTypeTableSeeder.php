<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkflowStateTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PROCESS
        $processes = [
            'ISSUANCE',
            'BORROW',
            'RECEIVING',
            'RETURN',
        ];
        foreach ($processes as $process) {
            DB::table('workflow_state_type')->insert([
                'workflow_level_type_id' => '1',
                'type_key' => $process
            ]);
        }

        // STATE
        $states = [
            'CREATE_REQUEST',
            'REQUEST_REVIEW',
            'PREPARE_REQUEST',
            'REQUEST_RECEIVE',
            'ITEM_RECEIVE',
            'CREATE_RETURN',
            'RETURN_REVIEW',
            'RETURN_RECEIVE',
            'REPAIR',
            'DISPOSE',
            'TRANSACTION_CLOSED',
        ];
        foreach ($states as $state) {
            DB::table('workflow_state_type')->insert([
                'workflow_level_type_id' => '2',
                'type_key' => $state
            ]);
        }

        // OUTCOME
        $outcomes = [
            'CREATED',
            'APPROVED',
            'REJECTED',
            'PREPARED',
            'ACCEPTED',
            'DECLINED',
            'REPAIRED',
            'NOT_REPAIRED',
        ];
        foreach ($outcomes as $outcome) {
            DB::table('workflow_state_type')->insert([
                'workflow_level_type_id' => '3',
                'type_key' => $outcome
            ]);
        }
    }
}
