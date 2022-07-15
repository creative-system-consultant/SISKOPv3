<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class CoopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::statement("DBCC CHECKIDENT ('SISKOP.coop',RESEED,1)");

        $coop = [
            [
                'name'          => 'COOP CSC',
                'name2'         => 'CSC',
                'type'          => 'coop',
                'reg_num'       => '1234567890-CSC',
                'description'   => 'Default COOP FOR SISKOPv3',
            ],
        ];

        DB::table('SISKOP.coop')->insert($coop);

        DB::statement("DBCC CHECKIDENT ('SISKOP.coop',RESEED,100)");
    }
}
