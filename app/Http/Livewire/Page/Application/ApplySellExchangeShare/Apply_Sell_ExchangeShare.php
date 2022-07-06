<?php

namespace App\Http\Livewire\Page\Application\ApplySellExchangeShare;

use App\Models\Customer;
use App\Models\Ref\RefBank;
use App\Models\share;
use Livewire\Component;

class Apply_Sell_ExchangeShare extends Component
{
    public Customer $cust;
    public $share_apply;
    public $bank_name;
    public $bank_account;
    public $banks;
    public $share;

    protected $rules = [
        'cust.name'       => 'required',
        'cust.icno'       => 'required',
        'cust.share'      => 'required',
        'share_apply'     => 'required|numeric',
        'bank_name'       => 'required',
        'bank_account'    => 'required',
    ];
    
    protected $messages = [
        'share_apply.required'       => ':attribute field is required',
        'bank_name.required'         => ':attribute field is required',
        'bank_account.required'      => ':attribute field is required'
    ];

    protected $validationAttributes = [
        'share_apply'     => 'Reimbursement of Share Capital applied',
        'bank_name'       => 'Bank',
        'bank_account'    => 'Account Bank No.'
    ];

    public function submit()
    {
        $this->validate();
        
        $user = auth()->user();
        $customer = Customer::where('icno', $user->icno)->first();

        $share = share::create([
            'coop_id'      => $customer->coop_id,
            'cust_id'      => $customer->id,
            'amt_before'   => $this->cust['share'] ??= '0',
            'apply_amt'    => $this->share_apply,
            'approved_amt' => NULL,
            'bank_code'    => $this->bank_name,
            'bank_account' => $this->bank_account,
            'direction'    => 'sell',
            'flag'         => '1',
            'step'         => '1',
        ]);

        session()->flash('message', 'Share Reimbursement Application Successfully Send');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('share.sell');  
    }

    public function restricApply($id)
    {
        $share = share::where([['cust_id', $id ], ['flag', 1], ['step', 1], ['direction', 'sell']])->first();

        if ($share != null) {
            session()->flash('message', 'Share reimbursement application is been processed. If you want to make another application, please wait until the application is processed');
            session()->flash('info');
            session()->flash('title');
    
            return redirect()->route('home');                                
        }
    }

    public function mount()
    {
        $user = auth()->user();
        $this->cust = Customer::where('icno', $user->icno)->first();
        $this->banks = RefBank::where('coop_id', $user->coop_id)->get();

        $this->share = share::where('cust_id', $this->cust->id)->firstOrCreate([
            'coop_id'     => $this->cust->coop_id, 
            'cust_id'     => $this->cust->id, 
            'amt_before'  => $this->cust->share,
            'apply_amt'   => '0.00',
            'direction'   => 'sell',
            'flag'        => 0, 
            'step'        => 0
        ]);

        $this->share_apply  = $this->share?->apply_amt;
        $this->bank_account = $this->share?->bank_account;
        $this->bank_name    = $this->bank_name === $this->share->bank_code ? 'selected' : '';

        $this->restricApply($this->cust->id);
    }

    public function render()
    {
        return view('livewire.page.application.apply-sell-exchange-share.apply-sell-exchange-share')->extends('layouts.head');
    }
}
