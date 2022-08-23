<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkflowStateHierarchyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // PROCESS
        $states = [
            // ISSUANCE TRANSACTIONS
            [
                'state_type_parent_id' => '1',
                'state_type_child_id' => '5'
            ],
            // BORROW TRANSACTION
            [
                'state_type_parent_id' => '2',
                'state_type_child_id' => '5'
            ],
            // RECEIVING TRANSACTION
            [
                'state_type_parent_id' => '3',
                'state_type_child_id' => '9'
            ],
            // RETURN TRANSACTION
            [
                'state_type_parent_id' => '4',
                'state_type_child_id' => '10'
            ],
            // CREATE REQUEST
            [
                'state_type_parent_id' => '5',
                'state_type_child_id' => '16'
            ],
            // REQUEST REVIEW
            [
                'state_type_parent_id' => '6',
                'state_type_child_id' => '17'
            ],
            [
                'state_type_parent_id' => '6',
                'state_type_child_id' => '18'
            ],
            // PREPARE REQUEST
            [
                'state_type_parent_id' => '7',
                'state_type_child_id' => '19'
            ],
            // REQUEST RECEIVED
            [
                'state_type_parent_id' => '8',
                'state_type_child_id' => '20'
            ],
            [
                'state_type_parent_id' => '8',
                'state_type_child_id' => '21'
            ],
            // ITEM RECEIVED
            [
                'state_type_parent_id' => '9',
                'state_type_child_id' => '20'
            ],
            // CREATE RETURN
            [
                'state_type_parent_id' => '10',
                'state_type_child_id' => '16'
            ],
            // RETURN REVIEW
            [
                'state_type_parent_id' => '11',
                'state_type_child_id' => '17'
            ],
            [
                'state_type_parent_id' => '11',
                'state_type_child_id' => '18'
            ],
            // RETURN RECEIVE
            [
                'state_type_parent_id' => '12',
                'state_type_child_id' => '20'
            ],
            [
                'state_type_parent_id' => '12',
                'state_type_child_id' => '21'
            ],
            // ITEM REPAIR
            [
                'state_type_parent_id' => '13',
                'state_type_child_id' => '22'
            ],
            [
                'state_type_parent_id' => '13',
                'state_type_child_id' => '23'
            ],
            // ITEM DISPOSE
            [
                'state_type_parent_id' => '14',
                'state_type_child_id' => '17'
            ],
            [
                'state_type_parent_id' => '14',
                'state_type_child_id' => '18'
            ],
        ];
        foreach ($states as $state) {
            DB::table('workflow_state_hierarchy')->insert([
                'state_type_parent_id' => $state['state_type_parent_id'],
                'state_type_child_id' => $state['state_type_child_id'],
            ]);
        }
    }
}
