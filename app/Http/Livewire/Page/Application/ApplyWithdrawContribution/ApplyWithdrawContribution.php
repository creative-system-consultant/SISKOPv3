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
    public $bank_name;
    public $bank_acct;
    public $total_contribution, $monthly_contribution;
    public $User;

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['submit'];

    protected $rules = [
        'cust.name'                 => 'required',
        'cust.icno'                 => 'required',
        'support_file'              => 'required',
    ];

    protected $messages = [
        'cont_apply.required'         => ':attribute field is required',
        'cont_apply.lte'              => 'Application must be less than Current Contribution RM:value',
        'cont_apply.gt'               => 'Application must be more than RM0',
        'cont_apply.numeric'          => ':attribute field must be number',
        'support_file.required'       => ':attribute field is required',
        'bank_code.required'          => ':attribute field is required',
        'bank_account.required'       => ':attribute field is required',
    ];

    protected $validationAttributes = [
        'cont_apply'      => 'Add Contribution Applied',
        'support_file'    => 'Upload Supporting Document',
        'bank_code'       => 'Bank',
        'bank_account'    => 'Account Bank No.',
    ];

    public function alertConfirm()
    {
        $this->validate();
        $this->validate($this->getSpecialRules());

        $this->validate($this->getContributionRules());
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',
            'text'      => 'Are you sure you want to apply for withdrawal contribution?',
        ]);
    }



    public function getContributionRules()
    {
        $rules = [
            'cont_apply' => [
                'required',
                'numeric',
                'min:10',
            ],

        ];


        $rules['cont_apply'][] = 'max:' . $this->total_contribution;


        return $rules;
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
            'bank_code'      => $this->bank_name,
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
        $this->banks           = RefBank::where([
            ['client_id', $this->User->client_id],
            ['status', '1'], ['bank_cust', 'Y']
        ])->orderBy('priority')->orderBy('description')->get();
        $this->total_contribution = $this->cust->fmsMembership->total_contribution;
        $this->monthly_contribution = $this->cust->fmsMembership->monthly_contribution;

        $this->restrictApply($this->cust->id);
        $this->applyCont($this->cust->id);
    }

    public function render()
    {
        $this->bank_name = $this->cust->bank_id;
        $this->bank_acct = $this->cust->bank_acct_no;
        return view('livewire.page.application.apply-withdraw-contribution.apply-withdraw-contribution')->extends('layouts.head');
    }
}
