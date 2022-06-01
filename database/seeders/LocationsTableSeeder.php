<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $names = [
            'All Lines',
            'Augustus',
            'D',
            'DIP',
            'Engineering',
            'Engineering Support',
            'FENWAY',
            'FG',
            'Kitting',
            'Line 1',
            'Line 2',
            'Line 3',
            'Line 4',
            'Line 5',
            'Line 6',
            'MH',
            'MPM',
            'MTSE',
            'Office',
            'Offline',
            'OPM',
            'PCBA',
            'PSite',
            'QA',
            'SMT',
            'SP',
            'Spare Parts',
            'SUPER POD',
            'TE',
            'Training',
            'TS',
            'TS Repair',
            'TS Rework',
            'TS Salvaging',
            'TSE',
            'WH',
            'Facilities',
            'GST',
            'Improvement',
            'IPQC',
            'IT',
            'MILES',
            'New Setup',
            'NPI',
            'PD',
            'Production',
            'QSite',
            'RP528B',
            'Safety',
            'Sever Room',
        ];
        foreach ($names as $name) {
            DB::table('locations')->insert([
                'name' => $name
            ]);
        }
    }
}
