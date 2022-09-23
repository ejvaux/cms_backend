<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkflowStateContextTableSeeder extends Seeder
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
                'state_type_id' => '1',
                'state_hierarchy_id' => '5'
            ],
            [
                'state_type_id' => '1',
                'state_hierarchy_id' => '6'
            ],
            [
                'state_type_id' => '1',
                'state_hierarchy_id' => '7'
            ],
            [
                'state_type_id' => '1',
                'state_hierarchy_id' => '8'
            ],
            [
                'state_type_id' => '1',
                'state_hierarchy_id' => '9'
            ],
            [
                'state_type_id' => '1',
                'state_hierarchy_id' => '10'
            ],
            // BORROW TRANSACTION
            [
                'state_type_id' => '2',
                'state_hierarchy_id' => '5'
            ],
            [
                'state_type_id' => '2',
                'state_hierarchy_id' => '6'
            ],
            [
                'state_type_id' => '2',
                'state_hierarchy_id' => '7'
            ],
            [
                'state_type_id' => '2',
                'state_hierarchy_id' => '8'
            ],
            [
                'state_type_id' => '2',
                'state_hierarchy_id' => '9'
            ],
            [
                'state_type_id' => '2',
                'state_hierarchy_id' => '10'
            ],
            // RECEIVING TRANSACTION
            [
                'state_type_id' => '3',
                'state_hierarchy_id' => '11'
            ],
            // RETURN TRANSACTION
            [
                'state_type_id' => '4',
                'state_hierarchy_id' => '12'
            ],
            [
                'state_type_id' => '4',
                'state_hierarchy_id' => '13'
            ],
            [
                'state_type_id' => '4',
                'state_hierarchy_id' => '14'
            ],
            [
                'state_type_id' => '4',
                'state_hierarchy_id' => '15'
            ],
            [
                'state_type_id' => '4',
                'state_hierarchy_id' => '16'
            ],
            [
                'state_type_id' => '4',
                'state_hierarchy_id' => '17'
            ],
            [
                'state_type_id' => '4',
                'state_hierarchy_id' => '18'
            ],
            [
                'state_type_id' => '4',
                'state_hierarchy_id' => '19'
            ],
            [
                'state_type_id' => '4',
                'state_hierarchy_id' => '20'
            ],

            // *******  CHANGES STARTS HERE

            // Borrow transaction - Added RETURN_RECEIVE
            [
                'state_type_id' => '2',
                'state_hierarchy_id' => '15'
            ],

            // Added EXPIRED all transactions
            // ISSUANCE
            [
                'state_type_id' => '1',
                'state_hierarchy_id' => '21'
            ],
            // BORROW
            [
                'state_type_id' => '2',
                'state_hierarchy_id' => '21'
            ],
            // RECEIVING
            [
                'state_type_id' => '3',
                'state_hierarchy_id' => '22'
            ],
            // RETURN
            [
                'state_type_id' => '4',
                'state_hierarchy_id' => '23'
            ],
        ];

        foreach ($states as $state) {
            DB::table('workflow_state_context')->insert([
                'state_type_id' => $state['state_type_id'],
                'state_hierarchy_id' => $state['state_hierarchy_id'],
                'child_disabled' => 'N',
            ]);
        }
    }
}
