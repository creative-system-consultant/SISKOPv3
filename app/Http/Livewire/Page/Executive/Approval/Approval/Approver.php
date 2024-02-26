<?php

namespace App\Http\Livewire\Page\Executive\Approval\Approval;

use App\Models\ApplyDividend;
use App\Models\ApplySpecialAid;
use App\Models\Approval;
use App\Models\ChangeGuarantor;
use App\Models\CloseMembership;
use App\Models\Contribution;
use App\Models\FmsGlobalParm;
use App\Models\Share;
use App\Models\Ref\RefBank;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Approver extends Component
{
    public User $User;
    public $Approval;
    public $Application;

    public $approval_type = 'lulus';
    public $banks = [];
    public $disable = 'readonly';
    public $forward = false;
    public $include = '';
    public $message = 'Application Voted Approve';
    public $page = 0;
    public $pagename = '';
    public $cleared_date;
    public $pagetype = '';
    public $vote = 'Vote';

    public $globalParm;
    public $client_bank_id;
    public $client_bank_name;
    public $client_bank_acct;

    public $acctApplicants;
    public $guarantorLists;
    public $jaminan;

    protected function rules()
    {
        $rules = [
            'Approval.note' => 'required|max:255',
            'client_bank_name' => 'nullable',
            'client_bank_acct' => 'nullable',
        ];

        return array_merge($rules, $this->custom_rule[$this->include]['rule']);
    }

    protected $custom_rule = [
        'share' => [
            'name' => 'Add Share',
            'type' => 'App\Models\Share',
            'page' => 2,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
            ],
        ],
        'sellshare' => [
            'name' => 'Sell Share',
            'type' => 'App\Models\Share',
            'page' => 3,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
                'Application.bank_code' => 'required',
            ],
        ],
        'exchangeshare' => [
            'name' => 'Transfer Share',
            'type' => 'App\Models\Share',
            'page' => 3,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
            ],
        ],
        'contribution' => [
            'name' => 'Add Contribution',
            'type' => 'App\Models\Contribution',
            'page' => 4,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
                'Application.start_approved' => 'after_or_equal:Application.start_apply',
                'Application.cheque_clear' => 'required|after:Application.cheque_date',
            ],
        ],
        'sellcontribution' => [
            'name' => 'Withdrawal Contribution',
            'type' => 'App\Models\Contribution',
            'page' => 5,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0',
                'Application.apply_amt' => 'required|gt:0',
            ],
        ],
        'dividend' => [
            'name' => 'Dividend',
            'type' => 'App\Models\ApplyDividend',
            'page' => 10,
            'rule' => [
                'Application.div_cash_approved' => 'required|gt:0',
                'Application.div_share_approved' => 'required|gt:0',
                'Application.div_contri_approved' => 'required|gt:0',
            ],
        ],
        'closemembership' => [
            'name' => 'Close Membership',
            'type' => 'App\Models\CloseMembership',
            'page' => 8,
            'rule' => [
                //'Application.approved_amt' => 'required|gt:0',
            ],
        ],
        'specialaid' => [
            'name' => 'Special Aid',
            'type' => 'App\Models\ApplySpecialAid',
            'page' => 6,
            'rule' => [
                'Application.approved_amt' => 'required|gt:0|numeric',
            ],
        ],
        'ChangeGuarantor' => [
            'name' => 'Change Guarantor',
            'type' => 'App\Models\ChangeGuarantor',
            'page' => 10,
            'rule' => [],
        ],
    ];

    public function xvalidate()
    {
        //ni solution en nasir. aku taknak argue
        if ($this->include == 'share' || $this->include == 'contribution') {
            if ($this->Application->method == 'cheque') {
                $this->Application->cheque_clear = $this->Application->cheque_clear;
            }
            if ($this->Application->method != 'cheque') {
                $this->Application->cheque_date = date('Y-m-d', strtotime('today'));
                $this->Application->cheque_clear = date('Y-m-d', strtotime("tomorrow"));
            }
            if ($this->include == 'contribution' && $this->Application->start_apply == NULL) {
                $this->Application->start_apply = date('Y-m-d', strtotime('today'));
                $this->Application->start_approved = date('Y-m-d', strtotime('today'));
            }
        }
        $this->validate();
        if ($this->include == 'share' || $this->include == 'contribution') {
            if ($this->Application->method != 'cheque') {
                $this->Application->cheque_date = null;
                $this->Application->cheque_clear = NULL;
            }
            if ($this->include == 'contribution' && $this->Application->start_apply == NULL) {
                $this->Application->start_apply = NULL;
                $this->Application->start_approved = NULL;
            }
        }
    }

    public function decline()
    {
        $this->approval_type = 'gagal';
        $this->message       = 'Application Voted decline';
        $this->next();
    }

    public function countVote()
    {
        //vote type unanimous
        if ($this->Application->current_approval()->rule_vote_type == 'unanimous') {
            // votes are contradictory
            if ($this->Application->approval_vote_yes() > 0 && $this->Application->approval_vote_no() > 0) {
                $this->Application->step++;
                // votes are all casted
            } else if ($this->Application->approvals()->where('type', 'like', 'vote%')->where('order', $this->Application->step)->whereNull('vote')->count() == 0) {
                if ($this->Application->approval_vote_yes() > 0) {
                    $this->doApproval();
                } else {
                    $this->Application->flag = 21;
                }
            }
        }

        //checks if vote absolute is true, and any votes are casted
        else if ($this->Application->current_approval()->rule_vote_type == 'absolute_approve') {
            if ($this->Application->approval_vote_yes() > 0) {
                $this->doApproval();
            } else if ($this->Application->approvals()->where('type', 'like', 'vote%')->where('order', $this->Application->step)->whereNull('vote')->count() == 0) {
                $this->Application->flag = 21;
            }
        }

        //checks if vote absolute is true, and any votes are casted
        else if ($this->Application->current_approval()->rule_vote_type == 'absolute_decline') {
            if ($this->Application->approval_vote_no() > 0) {
                $this->Application->flag = 21;
            } else if ($this->Application->approvals()->where('type', 'like', 'vote%')->where('order', $this->Application->step)->whereNull('vote')->count() == 0) {
                $this->doApproval();
            }
        }

        //checks if vote majority is true
        else if ($this->Application->current_approval()->rule_vote_type == 'majority') {
            if ($this->Application->approvals()->where('type', 'like', 'vote%')->where('order', $this->Application->step)->whereNull('vote')->count() == 0) {
                if ($this->Application->approvals()->where([['order', $this->Application->step], ['vote', 'lulus']])->count() > $this->Application->approvals()->where([['order', $this->Application->step], ['vote', 'gagal']])->count()) {
                    $this->doApproval();
                } else {
                    $this->Application->flag = 21;
                }
            }
        } else {
            //
        }
    }

    public function doApproval()
    {
        $this->Application->approved_date = now();
        $this->Application->flag = 20;
        $this->Application->save();

        $dbname = env('DB_DATABASE', 'fmsv2_dev');
        $spname = NULL;
        $result = NULL;

        switch ($this->include) {
            case 'share':
            case 'sellshare':
            case 'exchangeshare':
                $spname = $dbname . ".SISKOP.up_insert_shares_req_hst";
                break;
            case 'contribution':
            case 'sellcontribution':
                $spname = $dbname . ".SISKOP.up_insert_cont_req_hst";
                break;
            case 'dividend':
                $spname = $dbname . ".SISKOP.up_upd_dividend_withdraw";
                break;
            case 'specialaid':
                $spname = $dbname . ".SISKOP.up_insert_special_aid";
                break;
            case 'closemembership':
                $spname = $dbname . ".SISKOP.up_upd_close_mbrship";
                break;
            case 'changeguarantor':
                $spname = $dbname . ".SISKOP.up_upd_guarantor_change_req";
                break;
            default:
                // default SP
        }

        if ($spname != NULL) {
            $result = DB::select("EXEC " . $spname . " ?,?,?", [
                $this->User->client_id,
                $this->Application->id,
                $this->User->id,
            ]);
        } else {
            Log::critical("APPROVAL ERROR\nOP = Approver.\n ERR = NO SP");
        }

        if ($result != NULL) {
            if ($result[0]->SP_RETURN_CODE == 0) {
                Log::info("APPROVAL SUCCESS\n SP RETURN = " . json_encode($result));
            } else {
                Log::critical("APPROVAL ERROR\nOP = Approver.\n ERR = SP CALL RETURN ERROR\nSP RETURN = " . json_encode($result));

                $this->dispatchBrowserEvent('swal', [
                    'title' => 'Warning!',
                    'text'  => 'Warning, SISTEM PROCESS FAILED. Contact CSC ADMIN. APPROVER - ' . $this->include . ', process SP failed. Message: ' . $result[0]->SP_RETURN_MSG . '.',
                    'icon'  => 'warning',
                    'showConfirmButton' => false,
                    'timer' => 100000,
                ]);
            }
        } else {
            Log::critical("APPROVAL ERROR\nOP = Approver.\n ERR = SP CALL RETURN ERROR\nSP RETURN = " . json_encode($result));

            $this->dispatchBrowserEvent('swal', [
                'title' => 'ERROR!',
                'text'  => 'ERROR, SISTEM PROCESS FAILED. Contact CSC ADMIN. APPROVER - ' . $this->include . ', process SP failed.',
                'icon'  => 'error',
                'showConfirmButton' => false,
                'timer' => 100000,
            ]);
        }
    }

    public function next()
    {
        if ($this->approval_type != 'gagal') {
            $this->xvalidate();
        }
        $this->Approval->user_id = $this->User->id;
        $this->Approval->vote = $this->approval_type;

        $this->Approval->save();

        $this->countVote();
        $this->Application->save();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('time', 10000);
        session()->flash('title', 'Success!');

        return redirect()->route('application.list', ['page' => $this->custom_rule[$this->include]['page']]);
    }

    public function notfound()
    {
        session()->flash('message', 'Application does not exist');
        session()->flash('warning');
        session()->flash('time', 10000);
        session()->flash('title', 'Warning!');
    }

    public function mount($uuid, $include)
    {
        if (!in_array($include, ['share', 'sellshare', 'exchangeshare', 'contribution', 'sellcontribution', 'closemembership', 'specialaid', 'dividend', 'ChangeGuarantor'])) {
            $this->notfound();
            return redirect()->route('application.list', ['page' => $this->custom_rule[$this->include]['page']]);
        }
        $this->include  = $include;
        $this->page     = $this->custom_rule[$this->include]['page'] ?? '';
        $this->pagename = $this->custom_rule[$this->include]['name'] ?? '';
        $this->pagetype = $this->custom_rule[$this->include]['type'] ?? '';
        $this->User     = User::find(auth()->user()->id);

        if ($this->include == 'contribution' || $this->include == 'sellcontribution') {
            $this->Application = Contribution::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
            $this->Application->approved_amt = $this->Application->approved_amt ?? $this->Application->apply_amt;
        } else if ($this->include == 'share' || $this->include == 'sellshare' || $this->include == 'exchangeshare') {
            $this->Application = Share::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();

            $this->Application->approved_amt = $this->Application->approved_amt ?? $this->Application->apply_amt;
            $this->cleared_date = $this->Application->cheque_clear;
        } else if ($this->include == 'closemembership') {
            $this->Application = CloseMembership::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
            $user = $this->Application->customer->where('client_id', $this->User->client_id)->first();

            $this->acctApplicants = DB::table('FMS.MEMBERSHIP as A')
                ->join('FMS.ACCOUNT_MASTERS as B', 'B.mbr_no', '=', 'A.mbr_no')
                ->join('FMS.ACCOUNT_POSITIONS as C', 'C.account_no', '=', 'B.account_no')
                ->join('CIF.CUSTOMERS as D', 'D.id', '=', 'A.cif_id')
                ->select([
                    DB::raw('A.mbr_no as mbr_no_peminjam'),
                    'D.name',
                    'B.account_no',
                    'B.start_disbursed_date',
                    'B.duration',
                    'B.closed_date',
                    'C.bal_outstanding',
                    'C.month_arrears',
                    'C.instal_arrears'
                ])
                ->where('A.client_id', '=', $this->User->client_id)
                ->where('B.client_id', '=', $this->User->client_id)
                ->where('C.client_id', '=', $this->User->client_id)
                ->where('D.client_id', '=', $this->User->client_id)
                ->where('A.mbr_no', '=', $user->fmsMembership->mbr_no)
                ->where('B.account_status', '=', 1)
                ->where('C.bal_outstanding', '>', 0)
                ->orderBy('B.account_no')
                ->get();

            $this->acctApplicants = $this->acctApplicants->map(function ($item) {
                $item->start_disbursed_date = Carbon::parse($item->start_disbursed_date)->format('d/m/Y');
                $item->bal_outstanding = number_format($item->bal_outstanding, 2);
                $item->month_arrears = number_format($item->month_arrears, 2);
                $item->instal_arrears = number_format($item->instal_arrears, 2);

                return $item;
            });

            $this->guarantorLists = DB::table('FMS.GUARANTOR_LIST as A')
                ->join('FMS.MEMBERSHIP as B', 'B.mbr_no', '=', 'A.mbr_id')
                ->join('FMS.ACCOUNT_MASTERS as C', function ($join) {
                    $join->on('C.mbr_no', '=', 'B.mbr_no')
                        ->on('C.account_no', '=', 'A.account_no');
                })
                ->join('FMS.ACCOUNT_POSITIONS as D', 'D.account_no', '=', 'C.account_no')
                ->join('CIF.CUSTOMERS as E', 'E.id', '=', 'B.cif_id')
                ->select([
                    DB::raw('A.mbr_id as peminjam_dijamin'),
                    'E.name',
                    'A.account_no',
                    'C.start_disbursed_date',
                    'C.duration',
                    'C.closed_date',
                    'D.bal_outstanding',
                    'D.month_arrears',
                    'D.instal_arrears',
                ])
                ->where('A.client_id', '=', $this->User->client_id)
                ->where('B.client_id', '=', $this->User->client_id)
                ->where('C.client_id', '=', $this->User->client_id)
                ->where('D.client_id', '=', $this->User->client_id)
                ->where('A.guarantor_mbr_id', '=', $user->fmsMembership->mbr_no)
                ->where('A.guarantor_status', '=', 1)
                ->where('B.mbr_status', '=', 'A')
                ->where('C.account_status', '=', 1)
                ->where('D.bal_outstanding', '>', 0)
                ->orderBy('A.mbr_id')
                ->orderBy('A.account_no')
                ->get();

            $this->guarantorLists = $this->guarantorLists->map(function ($item) {
                $item->start_disbursed_date = Carbon::parse($item->start_disbursed_date)->format('d/m/Y');
                $item->closed_date = Carbon::parse($item->closed_date)->format('d/m/Y');
                $item->bal_outstanding =  number_format($item->bal_outstanding, 2);
                $item->month_arrears =  number_format($item->month_arrears, 2);
                $item->instal_arrears =  number_format($item->instal_arrears, 2);
                return $item;
            });

            $client = $this->User->client_id;
            $this->jaminan = DB::select("
                SELECT
                    C.name,
                    C.identity_no,
                    G.account_no,
                    P.bal_outstanding,
                    (
                        SELECT TOP 1 C.name FROM CIF.customers C
                        INNER JOIN FMS.MEMBERSHIP M ON C.id = M.cif_id AND M.client_id = '$client'
                        INNER JOIN FMS.GUARANTOR_LIST GSub ON M.mbr_no = GSub.mbr_id AND GSub.client_id = '$client'
                        WHERE P.account_no = GSub.account_no
                        AND C.client_id = '$client'
                    ) AS guarantee_name,
                    (
                        SELECT TOP 1 C.identity_no FROM CIF.customers C
                        INNER JOIN FMS.MEMBERSHIP M ON C.id = M.cif_id AND M.client_id = '$client'
                        INNER JOIN FMS.GUARANTOR_LIST GSub ON M.mbr_no = GSub.mbr_id AND GSub.client_id = '$client'
                        WHERE P.account_no = GSub.account_no
                        AND C.client_id = '$client'
                    ) AS guarantee_icno
                FROM CIF.customers C
                INNER JOIN FMS.MEMBERSHIP M ON C.id = M.cif_id AND M.client_id = '$client'
                INNER JOIN FMS.GUARANTOR_LIST G ON M.mbr_no = G.guarantor_mbr_id AND G.client_id = '$client'
                INNER JOIN FMS.account_positions P ON P.ACCOUNT_NO = G.ACCOUNT_NO AND P.client_id = '$client'
                WHERE C.identity_no = '$user->identity_no'
                AND P.bal_outstanding > 0
                AND C.client_id = '$client'
            ");
        } else if ($this->include == 'dividend') {
            $this->Application = ApplyDividend::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else if ($this->include == 'specialaid') {
            $this->Application = ApplySpecialAid::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else if ($this->include == 'ChangeGuarantor') {
            $this->Application = ChangeGuarantor::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else {
            $this->notfound();
            return redirect()->route('application.list', ['page' => 1]);
        }

        if ($this->Application == NULL) {
            $this->notfound();
            return redirect()->route('application.list', ['page' => 1]);
        }

        $this->Approval = Approval::where([
            ['approval_id', $this->Application->id],
            ['order', $this->Application->step],
            ['role_id', '4'],
            ['user_id', $this->User->id],
            ['approval_type', $this->pagetype],
        ])->first();
        if ($this->Approval == NULL) {
            session()->flash('message', 'Application is being processed by another staff');
            session()->flash('warning');
            session()->flash('title', 'Warning!');

            return redirect()->route('application.list', ['page' => '1']);
        } else if ($this->Approval->vote != NULL) {
            session()->flash('message', 'Application is have been processed by you');
            session()->flash('warning');
            session()->flash('title', 'Warning!');

            return redirect()->route('application.list', ['page' => '1']);
        }
        $this->banks = RefBank::where('client_id', $this->Application->client_id)->where('status', '1')->orderby('priority', 'asc')->orderby('description')->get();

        $this->globalParm = FmsGlobalParm::where('client_id', $this->User->client_id)->first();

        $this->client_bank_id = $this->globalParm->DEF_CLIENT_BANK_ID;
        $bank_name = RefBank::select('description')->where('id', $this->client_bank_id)->first();
        $this->client_bank_name = $bank_name->description;
        $this->client_bank_acct = $this->globalParm->DEF_CLIENT_BANK_ACCT_NO;
    }

    public function render()
    {
        return view('livewire.page.executive.approval.approval.approval')->extends('layouts.head');

        // @include('livewire.page.executive.approval.approval.contribution')
        // @include('livewire.page.executive.approval.approval.sellcontribution')
        // @include('livewire.page.executive.approval.approval.dividend')
        // @include('livewire.page.executive.approval.approval.share')
        // @include('livewire.page.executive.approval.approval.sellshare')
        // @include('livewire.page.executive.approval.approval.exchangeshare')
        // @include('livewire.page.executive.approval.approval.closemembership')
    }
}
