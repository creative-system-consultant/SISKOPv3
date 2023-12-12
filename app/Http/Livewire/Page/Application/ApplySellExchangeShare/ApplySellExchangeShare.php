<?php

namespace App\Http\Livewire\Page\Application\ApplySellExchangeShare;

use App\Models\Customer;
use App\Models\Ref\RefBank;
use App\Models\Share;
use Livewire\Component;

class ApplySellExchangeShare extends Component
{
    public Customer $cust;
    public $share_apply;
    public $share_type;
    public $mbr_icno;
    public $bank_name;
    public $bank_acct;
    public $bank_account;
    public $bank_code;
    public $banks;
    public $total_share;
    public $mbr_name;

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];

    protected $rules = [
        'cust.name'       => 'required',
        'cust.icno'       => 'required',
        'share_apply'     => 'required|numeric',
        'share_type'      => 'required',
        'bank_name'       => 'required_if:share_type,==,coop',
        'bank_account'    => 'required_if:share_type,==,coop',
        'mbr_icno'        => 'required_if:share_type,==,mbr',
        'bank_code'       => 'required_if:share_type,==,mbr',
        'bank_acct'       => 'required_if:share_type,==,mbr',
    ];

    protected $messages = [
        'mbr_icno.required_if'       => ':attribute field is required',
        'share_apply.required'       => ':attribute field is required',
        'share_apply.numeric'        => ':attribute field must be a number',
        // 'share_apply.lte'            => 'Application must be less than Current Share Capital RM:value',
        // 'share_apply.gt'             => 'Application must be more than RM0',
        'share_type.required'        => ':attribute is required',
        'bank_name.required_if'      => ':attribute field is required',
        'bank_code.required_if'      => ':attribute field is required',
        'bank_account.required_if'   => ':attribute field is required',
        'bank_acct.required_if'      => ':attribute field is required',
    ];

    protected $validationAttributes = [
        'mbr_icno'        => 'Member IC No.',
        'share_apply'     => 'Reimbursement of Share Capital applied',
        'share_type'      => 'Types of Share Reimbursement',
        'bank_name'       => 'Bank',
        'bank_code'       => 'Bank',
        'bank_account'    => 'Account Bank No.',
        'bank_acct'       => 'Account Bank No.'
    ];


    public function submit()
    {
        $user = auth()->user();
        $customer = new Customer;
        $cust = $customer->where('identity_no', $user->icno)->where('client_id', $user->client_id)->first();

        if ($this->share_type == 'coop') {
            $share = Share::where([['cust_id', $cust->id], ['flag', 0], ['step', 0], ['direction', 'sell']])->first();
            // dd($share);
            $share->update([
                'amt_before'   => $this->total_share,
                'apply_amt'    => $this->share_apply,
                'bank_code'    => $this->bank_name,
                'bank_account' => $this->bank_account,
                'flag'         => '1',
                'step'         => '1',
                'created_by'   => strtoupper($cust->name),
            ]);
        } elseif ($this->share_type == 'mbr') {
            $cust_member = $customer->where([['identity_no', $this->mbr_icno], ['identity_no', '<>', $user->icno]])->where('client_id', $user->client_id)->first();
            $share = Share::where([['cust_id', $cust->id], ['flag', 0], ['step', 0], ['direction', 'exchange']])->first();

            $share->update([
                'amt_before'   => $this->total_share,
                'apply_amt'    => $this->share_apply,
                'bank_code'    => $this->bank_code,
                'bank_account' => $this->bank_acct,
                'exc_cust_id'  => $cust_member->id,
                'flag'         => '1',
                'step'         => '1',
                'created_by'   => strtoupper($cust->name),
            ]);
        }

        $share->make_approvals();

        session()->flash('message', 'Share Reimbursement Application Successfully Send');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect('home');
    }

    public function alertConfirm()
    {
        $this->validate();

        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',
            'text'      => 'Are you sure you want to apply for share reimbursement?',
        ]);
    }

    public function restricApplySell($id)
    {
        $share = Share::where([['cust_id', $id], ['flag', 1], ['step', 1], ['direction', 'sell']])->first();

        if ($share != null) {
            session()->flash('message', 'Share reimbursement application is been processed. If you want to make another application, please wait until the application is processed');
            session()->flash('time', 10000);
            session()->flash('info');
            session()->flash('title');

            return redirect()->route('home');
        }
    }

    public function restricApplyExc($id)
    {
        $share = Share::where([['cust_id', $id], ['flag', 1], ['step', 1], ['direction', 'exchange']])->first();

        if ($share != null) {
            session()->flash('message', 'Share reimbursement application is been processed. If you want to make another application, please wait until the application is processed');
            session()->flash('time', 10000);
            session()->flash('info');
            session()->flash('title');

            return redirect()->route('home');
        }
    }


    public function contApplyMember($cust_id)
    {
        $share = Share::where('cust_id', $cust_id)->firstOrCreate([
            'client_id'     => $this->cust->client_id,
            'cust_id'     => $this->cust->id,
            'direction'   => 'exchange',
        ], [
            'amt_before'  => $this->total_share,
            'flag'        => 0,
            'step'        => 0,
            'apply_amt'   => '0.00',
        ]);

        $customer = Customer::where('id', $share->exc_cust_id)->first();

        $this->mbr_icno     = $customer?->icno;
        $this->share_apply  = $share?->apply_amt;
        $this->bank_acct    = $share?->bank_account;
        $this->bank_code    = $share?->bank_code;
    }

    public function contApplyCoop($cust_id)
    {
        $share = Share::where('cust_id', $cust_id)->firstOrCreate([
            'client_id'     => $this->cust->client_id,
            'cust_id'     => $this->cust->id,
            'direction'   => 'sell',
        ], [
            'amt_before'  => $this->total_share,
            'flag'        => 0,
            'step'        => 0,
            'apply_amt'   => '0.00',
        ]);

        $this->share_apply  = $share?->apply_amt;
        $this->bank_account = $share?->bank_account;
        $this->bank_name    = $share?->bank_code;
    }

    public function updated()
    {
        $user = auth()->user();
        $customer = Customer::where('identity_no', $this->mbr_icno)->where('client_id', $user->client_id)->first();
        if (strlen($this->mbr_icno) < 12) {
            $this->mbr_name = '';
            return;
        }

        if (strlen($this->mbr_icno) > 12) {
            $this->mbr_name = '';
            return;
        }

        if ($customer == NULL) {
            $this->dispatchBrowserEvent('swal', [
                'title' => '',
                'text'  => 'Customer Not Found',
                'icon'  => 'warning',
                'showConfirmButton' => false,
                'timer' => 1500,
            ]);
            $this->mbr_name = '';
        } else {
            if ($this->mbr_icno == $user->icno) {
                $this->dispatchBrowserEvent('swal', [
                    'title' => '',
                    'text'  => 'IC No. Cannot Be Yourself',
                    'icon'  => 'warning',
                    'showConfirmButton' => false,
                    'timer' => 1500,
                ]);
                $this->mbr_name = '';
            } elseif ($customer->fmsMembership->mbr_status == 'M') {
                $this->dispatchBrowserEvent('swal', [
                    'title' => '',
                    'text'  => 'You can`t transfer to a dormant member!',
                    'icon'  => 'warning',
                    'showConfirmButton' => false,
                    'timer' => 2500,
                ]);
                $this->mbr_name = '';
            } else {
                $this->mbr_name = $customer->name;
            }
        }
    }

    public function mount()
    {
        $user = auth()->user();
        $this->cust = Customer::where('identity_no', $user->icno)->where('client_id', $user->client_id)->first();
        $this->total_share = $this->cust->fmsMembership->total_share;

        $this->banks           = RefBank::where([
            ['client_id', $user->client_id],
            ['status', '1'], ['bank_cust', 'Y']
        ])->orderBy('priority')->orderBy('description')->get();

        $this->contApplyMember($this->cust->id);
        $this->contApplyCoop($this->cust->id);

        $this->restricApplySell($this->cust->id);
        $this->restricApplyExc($this->cust->id);
    }

    public function render()
    {
        return view('livewire.page.application.apply-sell-exchange-share.apply-sell-exchange-share')->extends('layouts.head');
    }
}
