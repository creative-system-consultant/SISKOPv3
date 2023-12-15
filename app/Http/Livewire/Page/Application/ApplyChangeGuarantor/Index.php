<?php

namespace App\Http\Livewire\Page\Application\ApplyChangeGuarantor;

use App\Models\AccountPosition;
use App\Models\Customer;
use App\Models\SiskopCustomer;
use Livewire\Component;

class Index extends Component
{
    public $user, $client_id, $siskop_cust, $fms_cust, $acct_master, $acct_position;

    public function mount()
    {
        $this->user = auth()->user();
        $this->client_id = $this->user->client_id;

        $this->siskop_cust      = SiskopCustomer::where('identity_no', $this->user->icno)->where('client_id', $this->client_id)->first();

        $this->fms_cust         = Customer::where([['client_id', $this->client_id], ['identity_no', $this->user->icno]])->firstOrFail();

        $membership             = $this->fms_cust->fmsMembership;

        $this->acct_master      = $membership->fmsAcctMaster;
        $this->acct_position   = [];

        foreach ($this->acct_master as $item) {
            // dump($item->account_no);
            $account_info = $item->account_no;
            $this->acct_position[] = AccountPosition::where('account_no', $account_info)->where('client_id', $this->client_id)->first();
        }

        // $this->acct_position    = $this->acct_master->position;
        dump($this->acct_position);
    }
    public function render()
    {
        // dd(auth()->user()->icno);
        return view('livewire.page.application.apply-change-guarantor.index')->extends('layouts.head');
    }
}
