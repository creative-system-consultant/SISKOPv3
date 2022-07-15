<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class FieldMasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $group = [
            [ 'description' => 'BASIC INFO',       'code' => '01' ],
            [ 'description' => 'SPOUSE INFO',      'code' => '02' ],
            [ 'description' => 'PARENT INFO',      'code' => '03' ],
            [ 'description' => 'WORK INFO',        'code' => '04' ],
            [ 'description' => 'BANK INFO',        'code' => '05' ],
            [ 'description' => 'BENEFIFIARY INFO', 'code' => '06' ],
            [ 'description' => 'GUARANTOR INFO',   'code' => '07' ],
            [ 'description' => 'REFERER INFO',     'code' => '08' ],
            [ 'description' => 'INTRODUCER INFO',  'code' => '09' ],
        ];

        DB::table('SISKOP.SYS_FIELD_GROUP')->insert($group);

        $field = [
            [
                'group_id'  => '01', 
                'name'      => 'TITLE',
                'name2'     => 'cust_title',
                'value'     => '$customer->title_id',
                'validation'=> NULL,
                'size'      => '3',
                'type'      => 'select',
                'pre'       => NULL,
                'post'      => NULL,
                'model'     => 'App\Models\Ref\RefCustTitle',
                'readonly'  => 'FALSE',
            ],
            [
                'group_id'  => '01', 
                'name'      => 'FULL NAME',
                'name2'     => 'custname',
                'value'     => '$customer->name',
                'validation'=> NULL,
                'size'      => '12',
                'type'      => 'text',
                'pre'       => NULL,
                'post'      => NULL,
                'model'     => NULL,
                'readonly'  => 'FALSE',
            ],
            [
                'group_id'  => '01', 
                'name'      => 'IDENTITY NUMBER',
                'name2'     => 'icno',
                'value'     => '$customer->icno',
                'validation'=> NULL,
                'size'      => '6',
                'type'      => 'text',
                'pre'       => NULL,
                'post'      => NULL,
                'model'     => NULL,
                'readonly'  => 'TRUE',
            ],
            [
                'group_id'  => '01', 
                'name'      => 'OTHER ID',
                'name2'     => 'otheric',
                'value'     => '$customer->otheric',
                'validation'=> NULL,
                'size'      => '6',
                'type'      => 'text',
                'pre'       => NULL,
                'post'      => NULL,
                'model'     => NULL,
                'readonly'  => 'TRUE',
            ],
            [
                'group_id'  => '01', 
                'name'      => 'BIRTHDATE',
                'name2'     => 'birthdate',
                'value'     => '$customer->birthdate',
                'validation'=> NULL,
                'size'      => '6',
                'type'      => 'date',
                'pre'       => NULL,
                'post'      => NULL,
                'model'     => NULL,
                'readonly'  => 'TRUE',
            ],
        ];

        DB::table('SISKOP.SYS_FIELD_MASTER')->insert($field);
    }
}
