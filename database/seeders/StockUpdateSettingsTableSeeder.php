<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockUpdateSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ADD
        $contexts = [
            '3',
            '6',
            '9',
            '12',
            '13',
            '17',
        ];
        foreach ($contexts as $context) {
            DB::table('stock_update_settings')->insert([
                'operation' => '+',
                'state_context_id' => $context
            ]);
        }

        // SUBTRACT
        $contexts = [
            '1',
            '7',
            '21',
        ];
        foreach ($contexts as $context) {
            DB::table('stock_update_settings')->insert([
                'operation' => '-',
                'state_context_id' => $context
            ]);
        }

        $transactions = [
            '1',
            '2'
        ];
        foreach ($transactions as $transaction) {
            DB::table('stock_update_settings')->insert([
                'operation' => '-',
                'transaction_type_id' => $transaction
            ]);
        }
    }
}
