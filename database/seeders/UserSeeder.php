<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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
                'name'      => 'Shahiran',
                'email'     => 'shahirankamal74@gmail.com',
                'phone_no ' => '01154243088',
                'icno'      => '020923100279',
                'password'  => $pass,
            ],
            [
                'name'      => 'Abu',
                'email'     => 'byedough11@gmail.com',
                'phone_no ' => '0127701210',
                'icno'      => '010403141131',
                'password'  => $pass,
            ],
            [
                'name'      => 'Hafiz',
                'email'     => 'hafidz@csc.net.my',
                'phone_no ' => '0121234501',
                'icno'      => '101010101001',
                'password'  => $pass,
            ],
            [
                'name'      => 'Faisol',
                'email'     => 'faisol@csc.net.my',
                'phone_no ' => '0121234502',
                'icno'      => '101010101002',
                'password'  => $pass,
            ],
            [
                'name'      => 'Irfan',
                'email'     => 'irfan@csc.net.my',
                'phone_no ' => '0121234503',
                'icno'      => '101010101003',
                'password'  => $pass,
            ],
            [
                'name'      => 'Nazirul',
                'email'     => 'nazirul@csc.net.my',
                'phone_no ' => '0121234504',
                'icno'      => '101010101004',
                'password'  => $pass,
            ],
            [
                'name'      => 'Iskandar',
                'email'     => 'iskandar@csc.net.my',
                'phone_no ' => '0121234505',
                'icno'      => '101010101005',
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
                'phone_no ' => '01234567899',
                'icno'      => '850409035142',
                'password'  => $pass,
            ],
            [
                'name'      => 'Eksekutif Shahiran',
                'email'     => 'akaun04@koperasi.com',
                'phone_no ' => '01234567890',
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
            [
                'name'      => 'Pegawai Aki',
                'email'     => 'pegawai@koperasi.com',
                'phone_no ' => '0183546800',
                'icno'      => '850409035145',
                'password'  => $pass,
            ],
            [
                'name'      => 'Pengurus Aki',
                'email'     => 'pengurus@koperasi.com',
                'phone_no ' => '0183546801',
                'icno'      => '850409035146',
                'password'  => $pass,
            ],
            [
                'name'      => 'Ketua Operasi Aki',
                'email'     => 'kpop@koperasi.com',
                'phone_no ' => '0183546802',
                'icno'      => '850409035148',
                'password'  => $pass,
            ],
        ];

        DB::table('SISKOP.users')->insert($users);

        DB::statement("DBCC CHECKIDENT ('SISKOP.users',RESEED,101)");

        $customers = [
            [
                'coop_id'   => '1',
                'name'      => 'Mohd Aizuddin',
                'icno'      => '850409035147',
                'share'     => '5000.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Danish',
                'icno'      => '011128140509',
                'share'     => '1500.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Shahiran',
                'icno'      => '020923100279',
                'share'     => '900.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Abu',
                'icno'      => '010403141131',
                'share'     => '900.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Eksekutif Aki',
                'icno'      => '850409035140',
                'share'     => '0.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Eksekutif Danish',
                'icno'      => '850409035141',
                'share'     => '0.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Eksekutif Abu',
                'icno'      => '850409035142',
                'share'     => '0.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Eksekutif Shahiran',
                'icno'      => '850409035143',
                'share'     => '0.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Admin Aki',
                'icno'      => '850409035144',
                'share'     => '0.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Pegawai Aki',
                'icno'      => '850409035145',
                'share'     => '0.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Pengurus Aki',
                'icno'      => '850409035146',
                'share'     => '0.00',
                'contribution'=> '200.00',
            ],
            [
                'coop_id'   => '1',
                'name'      => 'Ketua Operasi Aki',
                'icno'      => '850409035148',
                'share'     => '0.00',
                'contribution'=> '200.00',
            ],
        ];

        DB::statement("DBCC CHECKIDENT ('CIF.customers',RESEED,1)");
        DB::table('CIF.customers')->insert($customers);
        DB::statement("DBCC CHECKIDENT ('CIF.customers',RESEED,101)");
    }
}
