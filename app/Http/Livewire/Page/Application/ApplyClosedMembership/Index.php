<?php

namespace App\Http\Livewire\Page\Application\ApplyClosedMembership;

use App\Models\CloseMembership;
use App\Models\Customer;
use App\Models\SiskopCustomer;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $siskop_cust, $fms_cust, $user, $guaranteeFlag = 1;
    public $balance, $jaminan, $num_jaminan, $anggota, $reason, $balance_outstanding, $client_id;

    protected $listeners = ['submit'];

    protected $rules = [
        'reason'       => 'required|alpha_num'
    ];


    protected $validationAttributes = [
        'reason'        => 'Closing Account'
    ];

    public function mount()
    {
        $this->user = auth()->user();
        $this->client_id = $this->user->client_id;

        $this->siskop_cust = SiskopCustomer::where('identity_no', $this->user->icno)->where('client_id', $this->client_id)->first();

        $this->fms_cust    = Customer::where([['client_id', $this->client_id], ['identity_no', $this->user->icno]])->firstOrFail();

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
        // dd('yp');
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
                'client_id'           => $this->client_id,
                'cust_id'           => $this->fms_cust->id,
                'terminate_reason'  => $this->reason,
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

        return view('livewire.page.application.apply-closed-membership.index')->extends('layouts.head');
    }
}
