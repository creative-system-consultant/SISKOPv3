<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ApplyMembership;
use App\Models\Membership as ApplyMember;
use App\Models\Customer;

use App\Models\introducer;
use Livewire\Component;

class membership extends Component
{
    public ApplyMembership $applymember;
    public Customer $Cust, $CustApply;

    public function showApplication($uuid)
    {
        $this->custApply = ApplyMember::where('uuid', $uuid)->with('customer')->first();         
    }


    public function mount()    
    { 
        $user = auth()->user();
        $this->Cust              = Customer::where([['icno', $user->icno],['coop_id', $user->coop_id]])->first();  
        $this->applymember       = ApplyMembership::where(['cust_id' => $this->Cust->id, 'coop_id' => $user->coop_id],)->first();
        $this->introducer        = introducer::where('coop_id', $user->coop_id)->first();  
    }

    public function render()
    {
        return view('livewire.page.application.application-list.membership');
    }
}
