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
use DateTime;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Maker extends Component
{
    public User $User;
    public $Approval;
    public $Application;

    public $approval_type = 'lulus';
    public $banks = [];
    public $disable = '';
    public $forward = false;
    public $include = '';
    public $message = 'Application Pre-Approved';
    public $page = 0;
    public $pagename = '';
    public $pagetype = '';
    public $cleared_date;
    public $vote = 'Suggest';

    public $globalParm;
    public $client_bank_id;
    public $client_bank_name;
    public $client_bank_acct;

    public $acctApplicants;
    public $guarantorLists;
    public $jaminan;
    public $events_date;
    public $div_cash_approved,$div_share_approved,$div_contri_approved;

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
                'Application.div_cash_approved' => 'nullable',
                'Application.div_share_approved' => 'nullable',
                'Application.div_contri_approved' => 'nullable',
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
        if ($this->include == 'share' || $this->include == 'contribution') {
            if ($this->Application->method == 'cheque') {
                $this->Application->cheque_clear = $this->cleared_date;
            }
            if ($this->Application->method != 'cheque') {
                $this->Application->cheque_date = date('Y-m-d', strtotime('today'));
                $this->Application->cheque_clear = date('Y-m-d', strtotime("tomorrow"));
            }
            if ($this->include == 'contribution' && $this->Application->start_apply == NULL) {
                if ($this->Application->start_type == 1) {
                    $this->Application->start_apply = NULL;
                    $this->Application->start_approved = NULL;
                } else {
                    $this->Application->start_apply = date('Y-m-d', strtotime('today'));
                    $this->Application->start_approved = date('Y-m-d', strtotime('today'));
                }
            }
        }

        $this->validate();
    }

    public function shareValidation()
    {
        if ($this->include == 'share' || $this->include == 'contribution') {
            $rules = [
                'Application.cheque_clear' => [],
                'Application.approved_amt' => ['required', 'numeric'],
            ];
            $rules['Application.approved_amt'][] = 'max:' . $this->Application->apply_amt;

            if ($this->Application->method == 'cheque') {
                $rules['Application.cheque_clear'] = [
                    'required',
                    'after_or_equal:Application.cheque_date',
                    'before_or_equal:today',
                ];
            }
            return $rules;
        }
    }

    public function dividendValidation()
    {
        if ($this->include == 'dividend') {
            $rules = [
                'Application.div_cash_approved' => [
                    'nullable',
                    'numeric',
                ],
                'Application.div_share_approved' => [
                    'nullable',
                    'numeric',
                ],
                'Application.div_contri_approved' => [
                    'nullable',
                    'numeric',
                ],
            ];

            $rules['Application.div_cash_approved'][] = 'max:' . $this->Application->div_cash_apply;
            $rules['Application.div_share_approved'][] = 'max:' . $this->Application->div_share_apply;
            $rules['Application.div_contri_approved'][] = 'max:' . $this->Application->div_contri_apply;

            return $rules;
        }
    }

    public function contributionValidation()
    {
        if ($this->include == 'contribution' && $this->Application->start_type == 2) {
            $rules = [
                'Application.start_approved' => 'after_or_equal:Application.start_apply',
            ];
            return $rules;
        }
    }


    public function decline()
    {
        $this->approval_type = 'gagal';
        $this->message       = 'Application is reccomended to declined';
        $this->next();
    }

    public function next()
    {   
        if ($this->approval_type != 'gagal') {
            $this->validate($this->xvalidate());
            $this->validate($this->shareValidation());
            $this->validate($this->dividendValidation());
            $this->validate($this->contributionValidation());
        }

        $this->Application->step++;
        $this->Application->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = $this->approval_type;
        $this->Approval->save();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('time', 10000);
        session()->flash('title', 'Success!');

        return redirect()->route('application.list', ['page' => $this->custom_rule[$this->include]['page']]);
    }

    public function deb()
    {
        dd([
            'Approval' => $this->Approval,
            'Application' => $this->Application,
            'rules' => $this->rules(),
            'include' => $this->custom_rule[$this->include]['rule'],
        ]);
    }

    public function notfound()
    {
        session()->flash('message', 'Application don\'t exist');
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
        $this->page     = $this->custom_rule[$this->include]['page'];
        $this->pagename = $this->custom_rule[$this->include]['name'];
        $this->pagetype = $this->custom_rule[$this->include]['type'] ?? '';
        $this->User     = User::find(auth()->user()->id);


        if ($this->include == 'contribution' || $this->include == 'sellcontribution') {
            $this->Application = Contribution::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
            $this->Application->approved_amt = $this->Application->approved_amt ?? $this->Application->apply_amt;
        } else if ($this->include == 'share' || $this->include == 'sellshare' || $this->include == 'exchangeshare') {
            $this->Application = Share::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
            $this->Application->approved_amt = $this->Application->approved_amt ?? $this->Application->apply_amt;
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
                ->where('A.mbr_no', '=', $this->Application->customer->fmsMembership->mbr_no)
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
                ->join('FMS.MEMBERSHIP as B', 'B.mbr_no', '=', 'A.mbr_no')
                ->join('FMS.ACCOUNT_MASTERS as C', function ($join) {
                    $join->on('C.mbr_no', '=', 'B.mbr_no')
                        ->on('C.account_no', '=', 'A.account_no');
                })
                ->join('FMS.ACCOUNT_POSITIONS as D', 'D.account_no', '=', 'C.account_no')
                ->join('CIF.CUSTOMERS as E', 'E.id', '=', 'B.cif_id')
                ->select([
                    DB::raw('A.mbr_no as peminjam_dijamin'),
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
                ->where('A.guarantor_mbr_no', '=', $this->Application->customer->fmsMembership->mbr_no)
                ->where('A.guarantor_status', '=', 1)
                ->where('B.mbr_status', '=', 'A')
                ->where('C.account_status', '=', 1)
                ->where('D.bal_outstanding', '>', 0)
                ->orderBy('A.mbr_no')
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
                        INNER JOIN FMS.GUARANTOR_LIST GSub ON M.mbr_no = GSub.mbr_no AND GSub.client_id = '$client'
                        WHERE P.account_no = GSub.account_no
                        AND C.client_id = '$client'
                    ) AS guarantee_name,
                    (
                        SELECT TOP 1 C.identity_no FROM CIF.customers C
                        INNER JOIN FMS.MEMBERSHIP M ON C.id = M.cif_id AND M.client_id = '$client'
                        INNER JOIN FMS.GUARANTOR_LIST GSub ON M.mbr_no = GSub.mbr_no AND GSub.client_id = '$client'
                        WHERE P.account_no = GSub.account_no
                        AND C.client_id = '$client'
                    ) AS guarantee_icno
                FROM CIF.customers C
                INNER JOIN FMS.MEMBERSHIP M ON C.id = M.cif_id AND M.client_id = '$client'
                INNER JOIN FMS.GUARANTOR_LIST G ON M.mbr_no = G.guarantor_mbr_no AND G.client_id = '$client'
                INNER JOIN FMS.account_positions P ON P.ACCOUNT_NO = G.ACCOUNT_NO AND P.client_id = '$client'
                WHERE C.identity_no = '$user->identity_no'
                AND P.bal_outstanding > 0
                AND C.client_id = '$client'
            ");
        } else if ($this->include == 'dividend') {
            $this->Application = ApplyDividend::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
            $this->Application->div_cash_approved = number_format($this->Application->div_cash_apply, 2);
            $this->Application->div_share_approved = number_format($this->Application->div_share_apply, 2);
            $this->Application->div_contri_approved = number_format($this->Application->div_contri_apply, 2);
        } else if ($this->include == 'specialaid') {
            $this->Application = ApplySpecialAid::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
            $this->Application->approved_amt = $this->Application->approved_amt ?? $this->Application->apply_amt;
            $this->events_date = $this->Application->event_date;
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
            ['role_id', '1'],
            ['approval_type', $this->pagetype],
        ])->where(function ($query) {
            $query->where('user_id', NULL)
                ->orWhere('user_id', $this->User->id);
        })->first();

        if ($this->Approval == NULL) {
            session()->flash('message', 'Application is being processed by another staff');
            session()->flash('warning');
            session()->flash('title', 'Warning!');

            return redirect()->route('application.list', ['page' => '1']);
        } else {
            $this->Approval->user_id = $this->User->id;
            $this->Approval->save();
        }
        $this->banks = RefBank::where('client_id', $this->Application->client_id)->where('status', '1')->orderby('priority', 'asc')->orderby('description')->get();

        $this->globalParm = FmsGlobalParm::where('client_id', $this->User->client_id)->first();

        $this->client_bank_id = $this->globalParm->DEF_CLIENT_BANK_ID;
        $bank_name = RefBank::select('description')->where('id', $this->client_bank_id)->first();
        $this->client_bank_name = $bank_name->description;
        $this->client_bank_acct = $this->globalParm->DEF_CLIENT_BANK_ACCT_NO;

        if ($this->include == 'share' || $this->include == 'contribution') {
            if ($this->Application->method == 'cheque') {
                $this->Application->cheque_clear = $this->Application->cheque_clear ?? $this->Application->cheque_date;
            }
        }
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
