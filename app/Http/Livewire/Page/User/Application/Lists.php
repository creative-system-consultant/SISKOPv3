<?php

namespace App\Http\Livewire\Page\User\Application;

use App\Models\AccountApplication;
use App\Models\ApplyMembership;
use App\Models\ApplySpecialAid;
use App\Models\Contribution;
use App\Models\Customer;
use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;

class Lists extends Component
{
    public User $User;
    public Customer $Customer;
    public $banks;
    public $contributions;
    public $financings;
    public $memberships;
    public $sellShares;
    public $sell_share;
    public $shares;
    public $specialAids;
    public $withdrawals;

    public function mount()
    {
        $this->User      = auth()->user();
        $this->Customer  = Customer::where([['client_id', $this->User->client_id],['identity_no',$this->User->icno]])->firstOrFail();
        $this->banks     = RefBank::where('client_id', $this->User->client_id)->get();

        $this->financings   = AccountApplication::where([['client_id', $this->User->client_id],['cust_id', $this->Customer->id]])->get();
        $this->memberships  = ApplyMembership::where([['client_id', $this->User->client_id],['cust_id', $this->Customer->id]])->get();
        $this->shares       = Share::where([['client_id', $this->User->client_id],['cust_id', $this->Customer->id],['direction', 'buy']])->get();
        $this->sellShares   = Share::where([['client_id', $this->User->client_id],['cust_id', $this->Customer->id]])
                                   ->where(function($query) {
                                      $query->where('direction', 'sell');
                                      $query->orWhere('direction', 'exchange');
                                   })->get();
        $this->contributions= Contribution::where([['client_id', $this->User->client_id],['cust_id', $this->Customer->id],['direction','buy']])->get();
        $this->withdrawals  = Contribution::where([['client_id', $this->User->client_id],['cust_id', $this->Customer->id],['direction','withdraw']])->get();
        $this->specialAids  = ApplySpecialAid::where([['client_id', $this->User->client_id],['cust_id', $this->Customer->id]])->get();
    }

    public function showApplication()
    {
        //
    }

    public function render()
    {
        return view('livewire.page.user.application.lists')->extends('layouts.head');
    }
}
