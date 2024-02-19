<?php

namespace App\Http\Livewire\Page\Application\ApplyClosedMembership;

use App\Models\CloseMembership;
use App\Models\Customer;
use App\Models\SiskopCustomer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $siskop_cust, $fms_cust, $user, $guaranteeFlag = 1;
    public $balance, $jaminan, $num_jaminan, $anggota, $reason, $balance_outstanding, $client_id;

    protected $listeners = ['submit'];

    protected $rules = [
        'reason'       => 'required|string'
    ];

    protected $validationAttributes = [
        'reason'        => 'Closing Account'
    ];

    public function mount()
    {
        $this->user = auth()->user();
        $this->client_id = $this->user->client_id;

        $this->siskop_cust = SiskopCustomer::where('identity_no', $this->user->icno)->where('client_id', $this->client_id)->first();

        $this->fms_cust    = Customer::where([['client_id', $this->client_id], ['identity_no', $this->user->icno]])->with('fmsMembership')->firstOrFail();

        $this->balance = DB::select("
                        SELECT SUM(p.bal_outstanding) AS total_bal_outstanding
                        FROM siskop.CUSTOMERS u
                        INNER JOIN CIF.CUSTOMERS c ON u.identity_no = c.identity_no AND c.client_id = '$this->client_id'
                        INNER JOIN FMS.MEMBERSHIP cm ON c.id = cm.cif_id AND cm.client_id = '$this->client_id'
                        INNER JOIN FMS.ACCOUNT_MASTERS m ON cm.mbr_no = m.mbr_no AND m.client_id = '$this->client_id'
                        INNER JOIN FMS.ACCOUNT_POSITIONS p ON m.account_no = p.account_no AND p.client_id = '$this->client_id'
                        WHERE u.identity_no = '$this->user->icno'
                        and u.client_id = '$this->client_id'
                    ");
        $this->balance_outstanding = $this->balance[0]->total_bal_outstanding;

        $this->anggota = CloseMembership::where([
            ['cust_id', $this->siskop_cust->id],
            ['flag', '<>', 3]
        ])->first();


        if ($this->anggota != NULL) {
            if ($this->anggota->flag == '20') {
                session()->flash('message', 'Close Membership application has been processed. You only need to apply once.');
                session()->flash('time', 10000);
                session()->flash('info');
                session()->flash('title');
            } else {
                session()->flash('message', 'Close Membership application is been processed. If you want to make another application, please wait until the application is processed');
                session()->flash('time', 10000);
                session()->flash('info');
                session()->flash('title');
            }
            return redirect()->route('home');
        }
    }

    public function alertConfirm()
    {
        $this->validate();
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',
            'text'      => 'Are you sure you want to close your membership?',
        ]);
    }

    public function submit()
    {
        if ($this->balance_outstanding != 0) {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'Error!',
                'text'  => 'To close membership, you must have 0 guarantee',
                'icon'  => 'error',
                'showConfirmButton' => false,
                'timer' => 4500,
            ]);
        } else {
            $close_membership = CloseMembership::create([
                'cust_id'           => $this->fms_cust->id,
                'client_id'         => $this->client_id,
                'terminate_reason'  => $this->reason,
                'apply_date'        => now(),
                'icno'              => $this->fms_cust->identity_no,
                'flag'              => '1',
                'step'              => '1',
                'created_by'        => auth()->user()->name,
                'created_at'        => now()
            ]);

            $close_membership->remove_approvals();
            $close_membership->make_approvals('CloseMembership');

            session()->flash('message', 'Close Membership Application Successfully Applied');
            session()->flash('time', 10000);
            session()->flash('success');
            session()->flash('title');

            return redirect('home');
        }
    }

    public function render()
    {
        $user = $this->user->customer->where('client_id', $this->client_id)->first();

        $acctApplicants = DB::table('FMS.MEMBERSHIP as A')
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
            ->where('A.client_id', '=', $this->client_id)
            ->where('B.client_id', '=', $this->client_id)
            ->where('C.client_id', '=', $this->client_id)
            ->where('D.client_id', '=', $this->client_id)
            ->where('A.mbr_no', '=', $user->fmsMembership->mbr_no)
            ->where('B.account_status', '=', 1)
            ->where('C.bal_outstanding', '>', 0)
            ->orderBy('B.account_no')
            ->get();

        $acctApplicants = $acctApplicants->map(function ($item) {
            $item->start_disbursed_date = Carbon::parse($item->start_disbursed_date)->format('d/m/Y');
            $item->bal_outstanding = number_format($item->bal_outstanding, 2);
            $item->month_arrears = number_format($item->month_arrears, 2);
            $item->instal_arrears = number_format($item->instal_arrears, 2);

            return $item;
        });

        $guarantorLists = DB::table('FMS.GUARANTOR_LIST as A')
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
            ->where('A.client_id', '=', $this->client_id)
            ->where('B.client_id', '=', $this->client_id)
            ->where('C.client_id', '=', $this->client_id)
            ->where('D.client_id', '=', $this->client_id)
            ->where('A.guarantor_mbr_id', '=', $user->fmsMembership->mbr_no)
            ->where('A.guarantor_status', '=', 1)
            ->where('B.mbr_status', '=', 'A')
            ->where('C.account_status', '=', 1)
            ->where('D.bal_outstanding', '>', 0)
            ->orderBy('A.mbr_id')
            ->orderBy('A.account_no')
            ->get();

        $guarantorLists = $guarantorLists->map(function ($item) {
            $item->start_disbursed_date = Carbon::parse($item->start_disbursed_date)->format('d/m/Y');
            $item->closed_date = Carbon::parse($item->closed_date)->format('d/m/Y');
            $item->bal_outstanding =  number_format($item->bal_outstanding, 2);
            $item->month_arrears =  number_format($item->month_arrears, 2);
            $item->instal_arrears =  number_format($item->instal_arrears, 2);
            return $item;
        });

        $this->jaminan = DB::select("
            SELECT
                C.name,
                C.identity_no,
                G.account_no,
                P.bal_outstanding,
                (
                    SELECT TOP 1 C.name FROM CIF.customers C
                    INNER JOIN FMS.MEMBERSHIP M ON C.id = M.cif_id AND M.client_id = '$this->client_id'
                    INNER JOIN FMS.GUARANTOR_LIST GSub ON M.mbr_no = GSub.mbr_id AND GSub.client_id = '$this->client_id'
                    WHERE P.account_no = GSub.account_no
                    AND C.client_id = '$this->client_id'
                ) AS guarantee_name,
                (
                    SELECT TOP 1 C.identity_no FROM CIF.customers C
                    INNER JOIN FMS.MEMBERSHIP M ON C.id = M.cif_id AND M.client_id = '$this->client_id'
                    INNER JOIN FMS.GUARANTOR_LIST GSub ON M.mbr_no = GSub.mbr_id AND GSub.client_id = '$this->client_id'
                    WHERE P.account_no = GSub.account_no
                    AND C.client_id = '$this->client_id'
                ) AS guarantee_icno
            FROM CIF.customers C
            INNER JOIN FMS.MEMBERSHIP M ON C.id = M.cif_id AND M.client_id = '$this->client_id'
            INNER JOIN FMS.GUARANTOR_LIST G ON M.mbr_no = G.guarantor_mbr_id AND G.client_id = '$this->client_id'
            INNER JOIN FMS.account_positions P ON P.ACCOUNT_NO = G.ACCOUNT_NO AND P.client_id = '$this->client_id'
            WHERE C.identity_no = '$this->user->icno'
            AND P.bal_outstanding > 0
            AND C.client_id = '$this->client_id'
        ");

        if (!$this->jaminan) {
            $this->guaranteeFlag = 0;
        }

        $this->num_jaminan = DB::select("
                            SELECT COUNT (D.ACCOUNT_NO) AS NUM_GUARANTEE
                            FROM CIF.customers C
                            INNER JOIN FMS.MEMBERSHIP M ON C.id = M.cif_id AND M.client_id = '$this->client_id'
                            INNER JOIN FMS.GUARANTOR_LIST D ON M.mbr_no = D.guarantor_mbr_id AND D.client_id = '$this->client_id'
                            INNER JOIN FMS.account_positions P ON P.ACCOUNT_NO = D.ACCOUNT_NO AND P.client_id = '$this->client_id'
                            WHERE C.identity_no = '$this->user->icno'
                            AND P.bal_outstanding > 0
                            AND C.client_id = '$this->client_id'
                        ");

        return view('livewire.page.application.apply-closed-membership.index', [
            'acctApplicants' => $acctApplicants,
            'guarantorLists' => $guarantorLists,
        ])->extends('layouts.head');
    }
}
