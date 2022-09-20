<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorkflowStateOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $states = [
            // ISSUANCE TRANSACTIONS
            [
                'state_context_id' => '1',
                'state_type_id' => '6'
            ],
            [
                'state_context_id' => '2',
                'state_type_id' => '7'
            ],
            [
                'state_context_id' => '3',
                'state_type_id' => '5'
            ],
            [
                'state_context_id' => '3',
                'state_type_id' => '15'
            ],
            [
                'state_context_id' => '4',
                'state_type_id' => '8'
            ],
            [
                'state_context_id' => '5',
                'state_type_id' => '15'
            ],
            [
                'state_context_id' => '6',
                'state_type_id' => '5'
            ],
            [
                'state_context_id' => '6',
                'state_type_id' => '15'
            ],
            // BORROW TRANSACTION
            [
                'state_context_id' => '7',
                'state_type_id' => '6'
            ],
            [
                'state_context_id' => '8',
                'state_type_id' => '7'
            ],
            [
                'state_context_id' => '9',
                'state_type_id' => '5'
            ],
            [
                'state_context_id' => '9',
                'state_type_id' => '15'
            ],
            [
                'state_context_id' => '10',
                'state_type_id' => '8'
            ],
            [
                'state_context_id' => '11',
                'state_type_id' => '12' //Change from TRANSACTION_CLOSED, 15
            ],
            [
                'state_context_id' => '12',
                'state_type_id' => '5'
            ],
            [
                'state_context_id' => '12',
                'state_type_id' => '15'
            ],
            // RECEIVING TRANSACTION
            [
                'state_context_id' => '13',
                'state_type_id' => '15'
            ],
            // RETURN TRANSACTION
            [
                'state_context_id' => '14',
                'state_type_id' => '11'
            ],
            [
                'state_context_id' => '15',
                'state_type_id' => '12'
            ],
            [
                'state_context_id' => '16',
                'state_type_id' => '10'
            ],
            [
                'state_context_id' => '16',
                'state_type_id' => '15'
            ],
            [
                'state_context_id' => '17',
                'state_type_id' => '15'
            ],
            [
                'state_context_id' => '17',
                'state_type_id' => '13'
            ],
            [
                'state_context_id' => '17',
                'state_type_id' => '14'
            ],
            [
                'state_context_id' => '18',
                'state_type_id' => '10'
            ],
            [
                'state_context_id' => '18',
                'state_type_id' => '15'
            ],
            [
                'state_context_id' => '19',
                'state_type_id' => '15'
            ],
            [
                'state_context_id' => '20',
                'state_type_id' => '14'
            ],
            [
                'state_context_id' => '21',
                'state_type_id' => '15'
            ],
            [
                'state_context_id' => '22',
                'state_type_id' => '13'
            ],
            [
                'state_context_id' => '22',
                'state_type_id' => '15'
            ],

            // *******  CHANGES STARTS HERE

            // Borrow transaction - Added RETURN_RECEIVE
            [
                'state_context_id' => '23',
                'state_type_id' => '15'
            ],
        ];

        foreach ($states as $state) {
            DB::table('workflow_state_option')->insert([
                'state_context_id' => $state['state_context_id'],
                'state_type_id' => $state['state_type_id'],
            ]);
        }
    }
}
