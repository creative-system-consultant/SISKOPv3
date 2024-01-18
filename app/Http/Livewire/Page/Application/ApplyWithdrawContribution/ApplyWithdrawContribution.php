<?php

namespace App\Http\Livewire\Page\Application\ApplyWithdrawContribution;

use App\Models\Contribution;
use App\Models\Customer;
use App\Models\FmsGlobalParm;
use App\Models\Ref\RefBank;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class ApplyWithdrawContribution extends Component
{
    use WithFileUploads;

    public Customer $cust;
    public $cont_apply;
    public $support_file;
    public $bank_account;
    public $bank_code;
    public $banks;
    public $bank_id;
    public $bank_acct;
    public $total_contribution, $monthly_contribution;
    public $User;

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];

    protected $rules = [
        'cust.name'                 => 'required',
        'cust.icno'                 => 'required',
        'cust.bank_id'              => 'nullable',
    ];

    protected $messages = [
        'cont_apply.required'         => ':attribute field is required',
        'cont_apply.lte'              => 'Application must be less than Current Contribution RM:value',
        'cont_apply.gt'               => 'Application must be more than RM0',
        'cont_apply.numeric'          => 'Contribution must be number',
        'cont_apply.min'              => 'Application must be more than RM50',
        'cont_apply.max'              => 'Application must be less than Current Contribution Amount',
        'support_file.required'       => ':attribute field is required',
        'bank_code.required'          => ':attribute field is required',
        'bank_account.required'       => ':attribute field is required',
    ];

    public function getContributionRules()
    {
        $rules = [
            'cont_apply' => [
                'required',
                'numeric',
                'min:50',
                'max:' . $this->total_contribution,
            ],
        ];



        return $rules;
    }


    public function alertConfirm()
    {
        $this->validate($this->getContributionRules());
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',
            'text'      => 'Are you sure you want to apply for withdrawal contribution?',
        ]);
    }


    public function submit()
    {
        $customer = Customer::where('identity_no', $this->User->icno)->where('client_id', $this->User->client_id)->first();
        $contribution = Contribution::where([['cust_id', $customer->id], ['flag', 0], ['step', 0], ['direction', 'withdraw']])->first();

        $this->validate($this->getContributionRules());


        $contribution->update([
            'direction'      => 'withdraw',
            'amt_before'     => $this->total_contribution ??= '0',
            'apply_amt'      => $this->cont_apply,
            'approved_amt'   => NULL,
            'bank_code'      => $this->bank_id,
            'bank_account'   => $this->bank_acct,
            'flag'           => 1,
            'step'           => 1,
            'created_by'     => strtoupper($customer->name),
        ]);
        $contribution->remove_approvals();
        $contribution->make_approvals('SellContribution');

        session()->flash('message', 'Withdrawal Contribution Application Successfully Send');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('home');
    }

    public function restrictApply($id)
    {
        $contribution = Contribution::where([['cust_id', $id], ['flag', 1], ['step', 1], ['direction', 'withdraw']])->first();

        if ($contribution != null) {
            session()->flash('message', 'Withdrawal contribution application is been processed. If you want to make another application, please wait until the application is processed');
            session()->flash('time', 10000);
            session()->flash('info');
            session()->flash('title');

            return redirect()->route('home');
        }
    }

    public function applyCont($cust_id)
    {
        $contribution = Contribution::where('cust_id', $cust_id)->firstOrCreate([
            'client_id'     => $this->cust->client_id,
            'cust_id'     => $this->cust->id,
            'flag'      => 0,
            'step'      => 0,
            'direction'   => 'withdraw',

        ], [
            'amt_before'  => $this->total_contribution,
            'flag'        => 0,
            'step'        => 0,
            'apply_amt'   => '0.00',
        ]);

        $this->cont_apply   = $contribution?->apply_amt;
        $this->bank_account = $contribution?->bank_account;
        $this->bank_code    = $contribution?->bank_code;
    }

    public function mount()
    {
        $this->User = auth()->user();
        $this->cust = Customer::where('identity_no', $this->User->icno)->where('client_id', $this->User->client_id)->first();
        $this->bank_id           = RefBank::where([
            ['client_id', $this->User->client_id],
            ['status', '1'], ['bank_cust', 'Y']
        ])->orderBy('priority')->orderBy('description')->get();
        $this->total_contribution = $this->cust->fmsMembership->total_contribution;

        $this->monthly_contribution = $this->cust->fmsMembership->monthly_contribution;

        if ($this->total_contribution == 0) {
            session()->flash('message', 'You are unable to initiate a Contribution Withdrawal as your current Contribution balance stands at zero.');
            session()->flash('time', 10000);
            session()->flash('info');
            session()->flash('title');
            return redirect()->route('home');
        }
        $this->restrictApply($this->cust->id);
        $this->applyCont($this->cust->id);
    }

    public function render()
    {
        $this->bank_acct = $this->cust->bank_acct_no;
        return view('livewire.page.application.apply-withdraw-contribution.apply-withdraw-contribution')->extends('layouts.head');
    }
}
