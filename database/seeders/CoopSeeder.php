<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
                'state_id' => $allstate->where('description','SELANGOR')->first()->id,
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
                'client_id' => '1',
                'cust_id' => '1'
            ],
        ];
        DB::table('SISKOP.membership')->insert($membership);

        $role_group = [
            [
                'client_id'     => '1',
                'role_id'     => '1',       //maker
                'description' => 'PEGAWAI',
                'name'        => 'PEGAWAI',
                'status'      => '1'
            ],
            [
                'client_id'     => '1',
                'role_id'     => '2',       //checker
                'description' => 'PENGURUS',
                'name'        => 'PENGURUS',
                'status'      => '1'
            ],
            [
                'client_id'     => '1',
                'role_id'     => '2',       //checker
                'description' => 'KPOP',
                'name'        => 'KPOP',
                'status'      => '1'
            ],
            [
                'client_id'     => '1',
                'role_id'     => '4',       //approver
                'description' => 'ALK',
                'name'        => 'ALK',
                'status'      => '1'
            ],
        ];
        DB::table('SISKOP.CLIENT_ROLE_GROUP')->insert($role_group);

        $role_users = [
            [   'grouping_type' => 'App\Models\ClientRoleGroup', 'grouping_id' => '101', 'user_id' => '15', 'client_id' => '1' ],
            [   'grouping_type' => 'App\Models\ClientRoleGroup', 'grouping_id' => '102', 'user_id' => '16', 'client_id' => '1' ],
            [   'grouping_type' => 'App\Models\ClientRoleGroup', 'grouping_id' => '103', 'user_id' => '17', 'client_id' => '1' ],
            [   'grouping_type' => 'App\Models\ClientRoleGroup', 'grouping_id' => '104', 'user_id' => '15', 'client_id' => '1' ],
            [   'grouping_type' => 'App\Models\ClientRoleGroup', 'grouping_id' => '104', 'user_id' => '16', 'client_id' => '1' ],
            [   'grouping_type' => 'App\Models\ClientRoleGroup', 'grouping_id' => '104', 'user_id' => '1' , 'client_id' => '1' ],
        ];
        DB::table('SISKOP.USER_GROUP')->insert($role_users);

        $products = [
            [ 'name' => 'Financing iPhone', 'client_id' => '1', 'product_type' => '5', 'profit_rate' => '5', 'amt_min' => '2000', 'amt_max' => '10000', 'term_min' => '1', 'term_max' => '3'],
            [ 'name' => 'Financing KERETA', 'client_id' => '1', 'product_type' => '6', 'profit_rate' => '5', 'amt_min' => '2000', 'amt_max' => '10000', 'term_min' => '1', 'term_max' => '3'],
        ];
        DB::table('SISKOP.Account_products')->insert($products);


        DB::statement("DBCC CHECKIDENT ('SISKOP.coop',RESEED,101)");
        DB::statement("DBCC CHECKIDENT ('cif.address',RESEED,101)");
        DB::statement("DBCC CHECKIDENT ('SISKOP.membership',RESEED,101)");
    }
}
