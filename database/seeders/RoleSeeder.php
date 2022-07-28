<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

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
            [ 'name'      => 'COMITTEE', 'coop_id'   => '1', ],
            [ 'name'      => 'APPROVER', 'coop_id'   => '1', ],
        ];

        DB::table('SISKOP.SYS_ROLE')->insert($roles);
    }
}
