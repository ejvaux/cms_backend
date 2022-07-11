<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'ISSUANCE',
            'RECEIVING',
            'BORROW',
            'RETURN',
            'OTHERS'
        ];
        foreach ($names as $value) {
            DB::table('transaction_types')->insert([
                'name' => $value
            ]);
        }
    }
}
