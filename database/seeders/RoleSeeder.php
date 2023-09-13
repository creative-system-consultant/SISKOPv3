<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [ 'name'      => 'MAKER',    'coop_id'   => '1', ],
            [ 'name'      => 'CHECKER',  'coop_id'   => '1', ],
            [ 'name'      => 'COMMITTEE','coop_id'   => '1', ],
            [ 'name'      => 'APPROVER', 'coop_id'   => '1', ],
        ];

        DB::table('SISKOP.SYS_ROLE')->insert($roles);
    }
}
