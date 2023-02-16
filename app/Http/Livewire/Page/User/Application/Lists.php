<?php

namespace App\Http\Livewire\Page\User\Application;

use App\Models\AccountMaster;
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
    public $contribution;
    public $financing;
    public $memberships;
    public $sellShare;
    public $sell_share;
    public $shares;
    public $specialAid;
    public $withdrawals;

    public function mount()
    {
        $this->User      = auth()->user();
        $this->Customer  = Customer::where([['coop_id', $this->User->coop_id],['icno',$this->User->icno]])->firstOrFail();
        $this->banks     = RefBank::where('coop_id', $this->User->coop_id)->get();

        $this->financing    = AccountMaster::where([['coop_id', $this->User->coop_id],['cust_id', $this->Customer->id]])->get();
        $this->memberships  = ApplyMembership::where([['coop_id', $this->User->coop_id],['cust_id', $this->Customer->id]])->get();
        $this->shares       = Share::where([['coop_id', $this->User->coop_id],['cust_id', $this->Customer->id],['direction', 'buy']])->get();
        $this->sellShares   = Share::where([['coop_id', $this->User->coop_id],['cust_id', $this->Customer->id]])
                                   ->where(function($query) {
                                      $query->where('direction', 'sell');
                                      $query->orWhere('direction', 'exchange');
                                   })->get();
        $this->contributions= Contribution::where([['coop_id', $this->User->coop_id],['cust_id', $this->Customer->id],['direction','buy']])->get();
        $this->withdrawals  = Contribution::where([['coop_id', $this->User->coop_id],['cust_id', $this->Customer->id],['direction','withdraw']])->get();
        $this->specialAid   = ApplySpecialAid::where([['coop_id', $this->User->coop_id],['cust_id', $this->Customer->id]])->get();
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
