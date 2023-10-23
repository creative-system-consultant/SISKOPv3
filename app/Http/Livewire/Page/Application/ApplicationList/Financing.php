<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;



use App\Models\User;
use App\Models\AccountMaster;
use App\Models\Ref\RefGender;
use Livewire\Component;

class Financing extends Component
{
    public User $User;
    public AccountMaster $financing;
    public $financings;
    public $gender;
    public $genderName;

    public function closeApplication()
    {
        $this->financing = new AccountMaster;
    }

    public function showApplication($uuid)
    {
        $this->financing = AccountMaster::where('uuid', $uuid)->with('customer')->first();
        $this->genderName = RefGender::where('client_id', $this->financing->client_id)->get();
    }

    public function remake_approvals()
    {
        $this->financing->remove_approvals();
        $this->financing->make_approvals();
        $this->financing->apply_step = 1;
        $this->financing->save();

        $this->dispatchBrowserEvent('swal',[
            'title' => 'Success!',
            'text'  => 'Approvals have been reset',
            'icon'  => 'success',
            'showConfirmButton' => false,
            'timer' => 360000,
        ]);
    }

    public function mount()
    {
        $this->User = Auth()->user();

        $this->financings = AccountMaster::where('client_id', $this->User->client_id)
                            ->where('account_status','>','14')
                            ->select('id','uuid','cust_id','apply_step','purchase_price','product_id','created_at','account_status')
                            ->orderBy('created_at','desc')
                            ->with('customer:id,name,icno')
                            //->take(20)
                            ->get();

        $this->gender = RefGender::where('client_id', $this->User->client_id)->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.financing');
    }
}
