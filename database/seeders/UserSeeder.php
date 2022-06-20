<?php

namespace Database\Seeders;

use DB;
use Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("DBCC CHECKIDENT ('SISKOP.users',RESEED,1)");

        $pass = Hash::make('Csc@1234');
        $users = [
            [
                'name'      => 'Mohd Aizuddin', 
                'email'     => 'aizuddin.yusoff@ymail.com',
                'phone_no ' => '01835468080',
                'icno'      => '850409035147',
                'password'  => $pass,
            ],
            [
                'name'      => 'Danish', 
                'email'     => 'danish@gmail.com',
                'phone_no ' => '01165251881',
                'icno'      => '011128140509',
                'password'  => $pass,
            ],
            [
                'name'      => 'Eksekutif Aki', 
                'email'     => 'akaun01@koperasi.com',
                'phone_no ' => '0183546808',
                'icno'      => '850409035140',
                'password'  => $pass,
            ],
            [
                'name'      => 'Eksekutif Danish', 
                'email'     => 'akaun02@koperasi.com',
                'phone_no ' => '0183546808',
                'icno'      => '850409035141',
                'password'  => $pass,
            ],
            [
                'name'      => 'Eksekutif Abu', 
                'email'     => 'akaun03@koperasi.com',
                'phone_no ' => '0127701210',
                'icno'      => '850409035142',
                'password'  => $pass,
            ],
            [
                'name'      => 'Eksekutif Shahiran', 
                'email'     => 'akaun04@koperasi.com',
                'phone_no ' => '01154243088',
                'icno'      => '850409035143',
                'password'  => $pass,
            ],
            [
                'name'      => 'Admin Aki', 
                'email'     => 'admin@koperasi.com',
                'phone_no ' => '0183546808',
                'icno'      => '850409035144',
                'password'  => $pass,
            ],
        ];

        DB::table('SISKOP.users')->insert($users);

        DB::statement("DBCC CHECKIDENT ('SISKOP.users',RESEED,100)");
    }
}
