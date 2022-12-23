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
        DB::statement("DBCC CHECKIDENT ('cif.address',RESEED,1)");
        DB::statement("DBCC CHECKIDENT ('SISKOP.membership',RESEED,1)");
        $coop_type = DB::table('ref.coop_types')->select('id','description')->get();
        $allstate = DB::table('ref.states')->select('id','description')->get();
        $add_type = DB::table('ref.address_types')->select('id','description')->get();

        $coop_add = [
            [
                'addressable_type' =>  'App\Models\Coop',
                'addressable_id'   =>  '1',
                'address1' => 'NO 11, JALAN 9/6',
                'address2' => 'TAMAN IKS',
                'address3' => 'SEKSYEN 9',
                'postcode' => '43500',
                'town'     => 'BANDAR BARU BANGI',
                'def_state_id' => $allstate->where('description','SELANGOR')->first()->id,
            ],
        ];
        DB::table('cif.address')->insert($coop_add);

        $address  = DB::table('cif.address')->where('addressable_type', 'App\Models\Coop')->select('id','addressable_id')->get();
        $coop = [
            [
                'name'          => 'COOP CSC',
                'name2'         => 'CSC',
                'type_id'       => $coop_type->where('description','COOP')->first()->id,
                'address_id'    => $address->where('addressable_id', '1')->first()->id,
                'reg_num'       => '1234567890-CSC',
                'description'   => 'Default COOP FOR SISKOPv3',
            ],
        ];
        DB::table('SISKOP.coop')->insert($coop);

        $membership = [
            [
                'coop_id' => '1',
                'cust_id' => '1'
            ],
        ];
        DB::table('SISKOP.membership')->insert($membership);

        $role_group = [
            [
                'coop_id'     => '1',
                'role_id'     => '1',
                'description' => 'PEGAWAI',
                'name'        => 'PEGAWAI',
                'status'      => '1'
            ],
            [
                'coop_id'     => '1',
                'role_id'     => '2',
                'description' => 'PENGURUS',
                'name'        => 'PENGURUS',
                'status'      => '1'
            ],
            [
                'coop_id'     => '1',
                'role_id'     => '2',
                'description' => 'KPOP',
                'name'        => 'KPOP',
                'status'      => '1'
            ],
            [
                'coop_id'     => '1',
                'role_id'     => '4',
                'description' => 'ALK',
                'name'        => 'ALK',
                'status'      => '1'
            ],
        ];
        DB::table('SISKOP.COOP_ROLE_GROUP')->insert($role_group);

        $role_users = [
            [   'grouping_type' => 'App\Models\CoopRoleGroup', 'grouping_id' => '1', 'user_id' => '15' ],
            [   'grouping_type' => 'App\Models\CoopRoleGroup', 'grouping_id' => '2', 'user_id' => '16' ],
            [   'grouping_type' => 'App\Models\CoopRoleGroup', 'grouping_id' => '3', 'user_id' => '17' ],
            [   'grouping_type' => 'App\Models\CoopRoleGroup', 'grouping_id' => '4', 'user_id' => '15' ],
            [   'grouping_type' => 'App\Models\CoopRoleGroup', 'grouping_id' => '4', 'user_id' => '16' ],
            [   'grouping_type' => 'App\Models\CoopRoleGroup', 'grouping_id' => '4', 'user_id' => '1' ],
        ];
        DB::table('SISKOP.USER_GROUP')->insert($role_users);


        DB::statement("DBCC CHECKIDENT ('SISKOP.coop',RESEED,100)");
        DB::statement("DBCC CHECKIDENT ('cif.address',RESEED,100)");
        DB::statement("DBCC CHECKIDENT ('SISKOP.membership',RESEED,100)");
    }
}
