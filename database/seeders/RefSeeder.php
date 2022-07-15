<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class RefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $education = [
            ['description' => 'SPM',     'code' => 'SPM', 'coop_id' => '1'],
            ['description' => 'DEGREE',  'code' => 'DEG', 'coop_id' => '1'],
            ['description' => 'MASTER',  'code' => 'MAS', 'coop_id' => '1'],
            ['description' => 'PHD',     'code' => 'PHD', 'coop_id' => '1'],
        ];
        DB::table('ref.education')->insert($education);

        $bank = [
            ['description' => 'BANK MUAMALAT MALAYSIA', 'code' => 'BMMB', 'coop_id' => '1'],
            ['description' => 'MALAYAN BANKING BERHAD', 'code' => 'MBB',  'coop_id' => '1'],
        ];
        DB::table('ref.banks')->insert($bank);

        $country = [
            ['description' => 'MALAYSIA',  'code' => 'MY', 'coop_id' => '1'],
            ['description' => 'INDONESIA', 'code' => 'ID', 'coop_id' => '1'],
        ];
        DB::table('ref.countries')->insert($country);

        $country = [
            ['description' => 'MALAYSIA',  'code' => 'MY', 'coop_id' => '1'],
            ['description' => 'INDONESIA', 'code' => 'ID', 'coop_id' => '1'],
        ];
        DB::table('ref.countries')->insert($country);

        $marital = [
            ['description' => 'SINGLE',  'code' => 'S', 'coop_id' => '1'],
            ['description' => 'MARRIED', 'code' => 'M', 'coop_id' => '1'],
            ['description' => 'DIVORCED','code' => 'D', 'coop_id' => '1'],
        ];
        DB::table('ref.marital')->insert($marital);

        $titles = [
            ['description' => 'MR',     'code' => 'MR',     'coop_id' => '1'],
            ['description' => 'MRS',    'code' => 'MRS',    'coop_id' => '1'],
            ['description' => 'MS',     'code' => 'MS',     'coop_id' => '1'],
            ['description' => 'DR',     'code' => 'DR',     'coop_id' => '1'],
            ['description' => 'SIR',    'code' => 'SIR',    'coop_id' => '1'],
            ['description' => 'TUN',    'code' => 'TUN',    'coop_id' => '1'],
            ['description' => 'TAN SRI','code' => 'TS',     'coop_id' => '1'],
            ['description' => 'PUAN SRI','code' => 'PS',    'coop_id' => '1'],
            ['description' => 'DATO\'', 'code' => 'DATO\'', 'coop_id' => '1'],
            ['description' => 'DATUK',  'code' => 'DATUK',  'coop_id' => '1'],
            ['description' => 'DATIN',  'code' => 'DATIN',  'coop_id' => '1'],
        ];
        DB::table('ref.cust_titles')->insert($titles);

        $gender = [
            ['description' => 'MALE',   'code' => 'M', 'coop_id' => '1'],
            ['description' => 'FEMALE', 'code' => 'F', 'coop_id' => '1'],
            ['description' => 'OTHERS', 'code' => 'L', 'coop_id' => '1'],
        ];
        DB::table('ref.gender')->insert($gender);

        $race = [
            ['description' => 'MELAYU',       'code' => 'M',  'coop_id' => '1'],
            ['description' => 'CINA',         'code' => 'C',  'coop_id' => '1'],
            ['description' => 'INDIA',        'code' => 'I',  'coop_id' => '1'],
            ['description' => 'SIAM',         'code' => 'S',  'coop_id' => '1'],
            ['description' => 'IBAN',         'code' => 'IB', 'coop_id' => '1'],
            ['description' => 'BIDAYUH',      'code' => 'B',  'coop_id' => '1'],
            ['description' => 'KADAZAN',      'code' => 'K',  'coop_id' => '1'],
            ['description' => 'MELANAU',      'code' => 'E',  'coop_id' => '1'],
            ['description' => 'INDIA MUSLIM', 'code' => 'IM', 'coop_id' => '1'],
            ['description' => 'CINA MUSLIM',  'code' => 'CM', 'coop_id' => '1'],
            ['description' => 'ORANG ASLI',   'code' => 'A',  'coop_id' => '1'],
            ['description' => 'BUMIPUTERA SABAH','code' => 'BS',  'coop_id' => '1'],
            ['description' => 'BUMIPUTERA SARAWAK','code' => 'BA',  'coop_id' => '1'],
            ['description' => 'OTHERS',       'code' => 'L',  'coop_id' => '1'],
        ];
        DB::table('ref.races')->insert($race);

        $religion = [
            ['description' => 'ISLAM',   'code' => 'I', 'coop_id' => '1'],
            ['description' => 'KRISTIAN','code' => 'K', 'coop_id' => '1'],
            ['description' => 'HINDU',   'code' => 'H', 'coop_id' => '1'],
            ['description' => 'BUDDHA',  'code' => 'B', 'coop_id' => '1'],
            ['description' => 'CONFUCIUS','code' => 'C', 'coop_id' => '1'],
            ['description' => 'ATHEIS',  'code' => 'N', 'coop_id' => '1'],
            ['description' => 'ANIMISM', 'code' => 'A', 'coop_id' => '1'],
            ['description' => 'OTHERS',  'code' => 'L', 'coop_id' => '1'],
        ];
        DB::table('ref.religions')->insert($religion);

        $state = [
            ['description' => 'JOHOR',           'code' => '01', 'coop_id' => '1'],
            ['description' => 'KEDAH',           'code' => '02', 'coop_id' => '1'],
            ['description' => 'KELANTAN',        'code' => '03', 'coop_id' => '1'],
            ['description' => 'MELAKA',          'code' => '04', 'coop_id' => '1'],
            ['description' => 'NEGERI SEMBILAN', 'code' => '05', 'coop_id' => '1'],
            ['description' => 'PAHANG',          'code' => '06', 'coop_id' => '1'],
            ['description' => 'PULAU PINANG',    'code' => '07', 'coop_id' => '1'],
            ['description' => 'PERAK',           'code' => '08', 'coop_id' => '1'],
            ['description' => 'PERLIS',          'code' => '09', 'coop_id' => '1'],
            ['description' => 'SELANGOR',        'code' => '10', 'coop_id' => '1'],
            ['description' => 'TERENGGANU',      'code' => '11', 'coop_id' => '1'],
            ['description' => 'SABAH',           'code' => '12', 'coop_id' => '1'],
            ['description' => 'SARAWAK',         'code' => '13', 'coop_id' => '1'],
            ['description' => 'W.P KUALA LUMPUR','code' => '14', 'coop_id' => '1'],
            ['description' => 'W.P LABUAN',      'code' => '15', 'coop_id' => '1'],
            ['description' => 'W.P PUTRAJAYA',   'code' => '16', 'coop_id' => '1'],
        ];
        DB::table('ref.states')->insert($state);

        $address = [
            ['description' => 'HOME',      'coop_id' => '1'],
            ['description' => 'PERMANENT', 'coop_id' => '1'],
            ['description' => 'OFFICE',    'coop_id' => '1'],
            ['description' => 'EMPLOYER',  'coop_id' => '1'],
            ['description' => 'FAMILY',    'coop_id' => '1'],
        ];
        DB::table('ref.address_types')->insert($address);

        $cooptype = [
            ['description' => 'COOP', 'code' => 'CC'],
            ['description' => 'CLUB', 'code' => 'CL'],
        ];
        DB::table('ref.coop_types')->insert($cooptype);

        $product = [
            ['description' => 'HOME FINANCING',      'code' => 'HF', 'coop_id' => '1'],
            ['description' => 'PERSONAL FINANCING',  'code' => 'PF', 'coop_id' => '1'],
            ['description' => 'INVESTMENT FINANCING','code' => 'IF', 'coop_id' => '1'],
            ['description' => 'EDUCATION FINANCING', 'code' => 'EF', 'coop_id' => '1'],
            ['description' => 'PRODUCT FINANCING',   'code' => 'HP', 'coop_id' => '1'],
            ['description' => 'TAKAFUL',             'code' => 'TK', 'coop_id' => '1'],
        ];
        DB::table('ref.product_types')->insert($product);
    }
}
