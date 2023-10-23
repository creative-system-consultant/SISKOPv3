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
            [ 'name'      => 'MAKER',    'client_id'   => '1', ],
            [ 'name'      => 'CHECKER',  'client_id'   => '1', ],
            [ 'name'      => 'COMMITTEE','client_id'   => '1', ],
            [ 'name'      => 'APPROVER', 'client_id'   => '1', ],
        ];

        DB::table('SISKOP.SYS_ROLE')->insert($roles);
    }
}
