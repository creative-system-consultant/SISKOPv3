<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            ['description' => 'SPM',     'code' => 'SPM', 'client_id' => '1'],
            ['description' => 'DEGREE',  'code' => 'DEG', 'client_id' => '1'],
            ['description' => 'MASTER',  'code' => 'MAS', 'client_id' => '1'],
            ['description' => 'PHD',     'code' => 'PHD', 'client_id' => '1'],
        ];
        DB::table('ref.education')->insert($education);

        $bank = [
            ['description' => 'BANK MUAMALAT MALAYSIA', 'code' => 'BMMB', 'client_id' => '1'],
            ['description' => 'MALAYAN BANKING BERHAD', 'code' => 'MBB',  'client_id' => '1'],
        ];
        DB::table('ref.banks')->insert($bank);

        $country = [
            ['description' => 'MALAYSIA',  'code' => 'MY', 'client_id' => '1'],
            ['description' => 'INDONESIA', 'code' => 'ID', 'client_id' => '1'],
        ];
        DB::table('ref.countries')->insert($country);

        $country = [
            ['description' => 'MALAYSIA',  'code' => 'MY', 'client_id' => '1'],
            ['description' => 'INDONESIA', 'code' => 'ID', 'client_id' => '1'],
        ];
        DB::table('ref.countries')->insert($country);

        $fin_calc_type = [
            ['description' => 'RULE 78',           'code' => '78', 'client_id' => '1'],
            ['description' => 'FLAT RATE',         'code' => 'FR', 'client_id' => '1'],
            ['description' => 'REDUCING BALANCE',  'code' => 'RB', 'client_id' => '1'],
        ];
        DB::table('ref.fin_calc_type')->insert($fin_calc_type);

        $marital = [
            ['description' => 'SINGLE',  'code' => 'S', 'client_id' => '1'],
            ['description' => 'MARRIED', 'code' => 'M', 'client_id' => '1'],
            ['description' => 'DIVORCED','code' => 'D', 'client_id' => '1'],
        ];
        DB::table('ref.marital')->insert($marital);

        $titles = [
            ['description' => 'MR',     'code' => 'MR',     'client_id' => '1'],
            ['description' => 'MRS',    'code' => 'MRS',    'client_id' => '1'],
            ['description' => 'MS',     'code' => 'MS',     'client_id' => '1'],
            ['description' => 'DR',     'code' => 'DR',     'client_id' => '1'],
            ['description' => 'SIR',    'code' => 'SIR',    'client_id' => '1'],
            ['description' => 'TUN',    'code' => 'TUN',    'client_id' => '1'],
            ['description' => 'TAN SRI','code' => 'TS',     'client_id' => '1'],
            ['description' => 'PUAN SRI','code' => 'PS',    'client_id' => '1'],
            ['description' => 'DATO\'', 'code' => 'DATO\'', 'client_id' => '1'],
            ['description' => 'DATUK',  'code' => 'DATUK',  'client_id' => '1'],
            ['description' => 'DATIN',  'code' => 'DATIN',  'client_id' => '1'],
        ];
        DB::table('ref.cust_titles')->insert($titles);

        $gender = [
            ['description' => 'MALE',   'code' => 'M', 'client_id' => '1'],
            ['description' => 'FEMALE', 'code' => 'F', 'client_id' => '1'],
        ];
        DB::table('ref.gender')->insert($gender);

        $race = [
            ['description' => 'MELAYU',       'code' => 'M',  'client_id' => '1'],
            ['description' => 'CINA',         'code' => 'C',  'client_id' => '1'],
            ['description' => 'INDIA',        'code' => 'I',  'client_id' => '1'],
            ['description' => 'SIAM',         'code' => 'S',  'client_id' => '1'],
            ['description' => 'IBAN',         'code' => 'IB', 'client_id' => '1'],
            ['description' => 'BIDAYUH',      'code' => 'B',  'client_id' => '1'],
            ['description' => 'KADAZAN',      'code' => 'K',  'client_id' => '1'],
            ['description' => 'MELANAU',      'code' => 'E',  'client_id' => '1'],
            ['description' => 'INDIA MUSLIM', 'code' => 'IM', 'client_id' => '1'],
            ['description' => 'CINA MUSLIM',  'code' => 'CM', 'client_id' => '1'],
            ['description' => 'ORANG ASLI',   'code' => 'A',  'client_id' => '1'],
            ['description' => 'BUMIPUTERA SABAH','code' => 'BS',  'client_id' => '1'],
            ['description' => 'BUMIPUTERA SARAWAK','code' => 'BA',  'client_id' => '1'],
            ['description' => 'OTHERS',       'code' => 'L',  'client_id' => '1'],
        ];
        DB::table('ref.races')->insert($race);

        $religion = [
            ['description' => 'ISLAM',   'code' => 'I', 'client_id' => '1'],
            ['description' => 'KRISTIAN','code' => 'K', 'client_id' => '1'],
            ['description' => 'HINDU',   'code' => 'H', 'client_id' => '1'],
            ['description' => 'BUDDHA',  'code' => 'B', 'client_id' => '1'],
            ['description' => 'CONFUCIUS','code' => 'C', 'client_id' => '1'],
            ['description' => 'ATHEIS',  'code' => 'N', 'client_id' => '1'],
            ['description' => 'ANIMISM', 'code' => 'A', 'client_id' => '1'],
            ['description' => 'OTHERS',  'code' => 'L', 'client_id' => '1'],
        ];
        DB::table('ref.religions')->insert($religion);

        $state = [
            ['description' => 'JOHOR',           'code' => '01', 'client_id' => '1'],
            ['description' => 'KEDAH',           'code' => '02', 'client_id' => '1'],
            ['description' => 'KELANTAN',        'code' => '03', 'client_id' => '1'],
            ['description' => 'MELAKA',          'code' => '04', 'client_id' => '1'],
            ['description' => 'NEGERI SEMBILAN', 'code' => '05', 'client_id' => '1'],
            ['description' => 'PAHANG',          'code' => '06', 'client_id' => '1'],
            ['description' => 'PULAU PINANG',    'code' => '07', 'client_id' => '1'],
            ['description' => 'PERAK',           'code' => '08', 'client_id' => '1'],
            ['description' => 'PERLIS',          'code' => '09', 'client_id' => '1'],
            ['description' => 'SELANGOR',        'code' => '10', 'client_id' => '1'],
            ['description' => 'TERENGGANU',      'code' => '11', 'client_id' => '1'],
            ['description' => 'SABAH',           'code' => '12', 'client_id' => '1'],
            ['description' => 'SARAWAK',         'code' => '13', 'client_id' => '1'],
            ['description' => 'W.P KUALA LUMPUR','code' => '14', 'client_id' => '1'],
            ['description' => 'W.P LABUAN',      'code' => '15', 'client_id' => '1'],
            ['description' => 'W.P PUTRAJAYA',   'code' => '16', 'client_id' => '1'],
        ];
        DB::table('ref.states')->insert($state);

        $address = [
            ['description' => 'HOME',      'client_id' => '1'],
            ['description' => 'PERMANENT', 'client_id' => '1'],
            ['description' => 'OFFICE',    'client_id' => '1'],
            ['description' => 'EMPLOYER',  'client_id' => '1'],
            ['description' => 'FAMILY',    'client_id' => '1'],
        ];
        DB::table('ref.address_types')->insert($address);

        $cooptype = [
            ['description' => 'COOP', 'code' => 'CC', 'status' => '1'],
            ['description' => 'CLUB', 'code' => 'CL', 'status' => '1'],
        ];
        DB::table('ref.coop_types')->insert($cooptype);

        $product = [
            ['description' => 'HOME FINANCING',      'code' => 'HF', 'client_id' => '1'],
            ['description' => 'PERSONAL FINANCING',  'code' => 'PF', 'client_id' => '1'],
            ['description' => 'INVESTMENT FINANCING','code' => 'IF', 'client_id' => '1'],
            ['description' => 'EDUCATION FINANCING', 'code' => 'EF', 'client_id' => '1'],
            ['description' => 'PRODUCT FINANCING',   'code' => 'HP', 'client_id' => '1'],
            ['description' => 'CAR FINANCING',       'code' => 'CF', 'client_id' => '1'],
            ['description' => 'TAKAFUL',             'code' => 'TK', 'client_id' => '1'],
            ['description' => 'MEDICAL CARD',        'code' => 'MC', 'client_id' => '1'],
        ];
        DB::table('ref.product_types')->insert($product);

        $memberDocument = [
            ['description' => 'IDENTIFICATION CARD (FRONT & BACK)',     'code' => 'IC', 'client_id' => '1'],
            ['description' => 'WORKER CARD (FRONT)',                    'code' => 'WC', 'client_id' => '1'],
            ['description' => 'LATEST PAYCHECK',                        'code' => 'P1', 'client_id' => '1'],
            ['description' => 'LAST MONTH PAYCHECK',                    'code' => 'P2', 'client_id' => '1'],
            ['description' => 'LAST 2 MONTH PAYCHECK',                  'code' => 'P3', 'client_id' => '1'],
            ['description' => 'EMPLOYER VERIFICATION',                  'code' => 'EV', 'client_id' => '1'],
        ];
        DB::table('ref.membership_documents')->insert($memberDocument);

        $notification = [
            ['description' => 'MEMBERSHIP',     'code' => 'MBR'],
            ['description' => 'FINANCING',      'code' => 'FIN'],
            ['description' => 'SPECIAL AID',    'code' => 'AID'],
        ];
        DB::table('ref.notification')->insert($notification);

        $account_status = [
            ['description' => 'ACTIVE',         'code' => '1'],
            ['description' => 'CLOSE',          'code' => '2'],
            ['description' => 'TRANSFERRED',    'code' => '3'],
            ['description' => 'TO BE TRANSFER', 'code' => '4'],
            ['description' => 'EXPIRED',        'code' => '5'],
            ['description' => 'JUDGMENT',       'code' => '6'],
            ['description' => 'FROZEN',         'code' => '7'],
            ['description' => 'LEGAL ACTION',   'code' => '8'],
            ['description' => 'WRITE-OFF',      'code' => '9'],
            ['description' => 'RECALL',         'code' => '10'],
            ['description' => 'CANCEL',         'code' => '11'],
            ['description' => 'FAILED',         'code' => '12'],
        ];
        DB::table('ref.account_statuses')->insert($account_status);

        $ic_type = [
            ['description' => 'MyKAD',      'code' => '1', 'status' => '1'],
            ['description' => 'OLD IC',     'code' => '2', 'status' => '1'],
            ['description' => 'MyPR',       'code' => '3', 'status' => '1'],
            ['description' => 'MyKAS',      'code' => '4', 'status' => '1'],
            ['description' => 'MyKID',      'code' => '5', 'status' => '1'],
            ['description' => 'POLICE',     'code' => '6', 'status' => '1'],
            ['description' => 'MILITARY',   'code' => '7', 'status' => '1'],
        ];
        DB::table('ref.identification_type')->insert($ic_type);

        $language = [
            ['description' => 'ENGLISH',       'client_id' => '1', 'code' => 'EN', 'status' => '1'],
            ['description' => 'BAHASA MELAYU', 'client_id' => '1', 'code' => 'BM', 'status' => '1'],
        ];
        DB::table('ref.language')->insert($language);

        $statuses = [
            ['description' => 'APPLYING',      'code' => '0'],
            ['description' => 'PROCESS START', 'code' => '1'],
            ['description' => 'reserved',      'code' => '2'],
            ['description' => 'USER CANCELED', 'code' => '3'],
            ['description' => 'COOP CANCELED', 'code' => '4'],
            ['description' => 'RESOLUTION',    'code' => '11'],
            ['description' => 'APPROVED',      'code' => '20'],
            ['description' => 'USER REJECTED', 'code' => '23'],
            ['description' => 'COOP REJECTED', 'code' => '24'],
            ['description' => 'RESOLUTION REJECTED', 'code' => '25'],
        ];
        DB::table('ref.apply_status')->insert($statuses);

        $steps = [
            ['description' => 'APPLYING',             'code' => '0', 'type' => 'share_sell', 'status' => '1'],
            ['description' => 'WAITING CONFIRMATION', 'code' => '1', 'type' => 'share_sell', 'status' => '1'],
            ['description' => 'PROCESSING',           'code' => '2', 'type' => 'share_sell', 'status' => '1'],
            ['description' => 'APPROVED',             'code' => '3', 'type' => 'share_sell', 'status' => '1'],
            ['description' => 'APPLYING',             'code' => '0', 'type' => 'membership', 'status' => '1'],
            ['description' => 'APPLIED',              'code' => '1', 'type' => 'membership', 'status' => '1'],
            ['description' => 'PROCESSING',           'code' => '2', 'type' => 'membership', 'status' => '1'],
        ];
        DB::table('ref.steps')->insert($steps);

        $relationship = [
            ['description' => 'HUSBAND',          'code' => 'H',  'client_id' => '1', 'status' => '1'],
            ['description' => 'WIFE',             'code' => 'W',  'client_id' => '1', 'status' => '1'],
            ['description' => 'SON',              'code' => 'S',  'client_id' => '1', 'status' => '1'],
            ['description' => 'DAUGHTER',         'code' => 'D',  'client_id' => '1', 'status' => '1'],
            ['description' => 'FATHER',           'code' => 'F',  'client_id' => '1', 'status' => '1'],
            ['description' => 'MOTHER',           'code' => 'M',  'client_id' => '1', 'status' => '1'],
            ['description' => 'BROTHER',          'code' => 'B',  'client_id' => '1', 'status' => '1'],
            ['description' => 'SISTER',           'code' => 'S',  'client_id' => '1', 'status' => '1'],
            ['description' => 'UNCLE',            'code' => 'U',  'client_id' => '1', 'status' => '1'],
            ['description' => 'AUNT',             'code' => 'A',  'client_id' => '1', 'status' => '1'],
            ['description' => 'COUSIN',           'code' => 'C',  'client_id' => '1', 'status' => '1'],
            ['description' => 'NEPHEW',           'code' => 'N1', 'client_id' => '1', 'status' => '1'],
            ['description' => 'NIECE',            'code' => 'N2', 'client_id' => '1', 'status' => '1'],
            ['description' => 'GRANDFATHER',      'code' => 'GF', 'client_id' => '1', 'status' => '1'],
            ['description' => 'GRANDMOTHER',      'code' => 'GM', 'client_id' => '1', 'status' => '1'],
            ['description' => 'GRANDSON',         'code' => 'GS', 'client_id' => '1', 'status' => '1'],
            ['description' => 'GRANDDAUGHTER',    'code' => 'GD', 'client_id' => '1', 'status' => '1'],
            ['description' => 'OTHERS',           'code' => 'O',  'client_id' => '1', 'status' => '1'],
            ['description' => 'FRIEND',           'code' => 'FR', 'client_id' => '1', 'status' => '1'],
            ['description' => 'FIANCE',           'code' => 'FI', 'client_id' => '1', 'status' => '1'],
         ];
        DB::table('ref.relationships')->insert($relationship);

        $approval_type = [
            ['description' => 'SPECIAL AID',           'client_id' => '1', 'code' => 'special_aid'],
            ['description' => 'FINANCING',             'client_id' => '1', 'code' => 'fin_apply'],
            ['description' => 'MEMBERSHIP',            'client_id' => '1', 'code' => 'member_apply'],
            ['description' => 'STOP MEMBERSHIP',       'client_id' => '1', 'code' => 'member_stop'],
            ['description' => 'ADD SHARE',             'client_id' => '1', 'code' => 'share_add'],
            ['description' => 'SELL SHARE',            'client_id' => '1', 'code' => 'share_sell'],
            ['description' => 'ADD CONTIBUTION',       'client_id' => '1', 'code' => 'contri_add'],
            ['description' => 'WITHDRAW CONTRIBUTION', 'client_id' => '1', 'code' => 'contri_wd'],
            ['description' => 'DIVIDEND PAYOUT',       'client_id' => '1', 'code' => 'dividend'],
        ];
        DB::table('ref.approval_types')->insert($approval_type);

        $product_documents = [
            ['description' => 'Latest Pay Slip',                 'client_id' => '1', 'code' => 'pay_slip'],
            ['description' => 'Last Month Pay Slip',             'client_id' => '1', 'code' => 'pay_slip2'],
            ['description' => 'Last 2 Month Pay Slip',           'client_id' => '1', 'code' => 'pay_slip3'],
            ['description' => 'Guatantor Latest Pay Slip',       'client_id' => '1', 'code' => 'g_pay_slip'],
            ['description' => 'Guarantor Last Month Pay Slip',   'client_id' => '1', 'code' => 'g_pay_slip2'],
            ['description' => 'Guarantor Last 2 Month Pay Slip', 'client_id' => '1', 'code' => 'g_pay_slip3'],
            ['description' => 'MYKAD (Front & Back)',            'client_id' => '1', 'code' => 'ic'],
            ['description' => 'MYKAD (Spouse)',                  'client_id' => '1', 'code' => 'ic_spouse'],
            ['description' => 'MYKAD (Child)',                   'client_id' => '1', 'code' => 'ic_child'],
            ['description' => 'Work Confirmation',               'client_id' => '1', 'code' => 'work_confirm'],
        ];
        DB::table('ref.product_documents')->insert($product_documents);
    }
}
