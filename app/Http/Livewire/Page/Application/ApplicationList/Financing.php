<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;



use App\Models\User;
use App\Models\AccountApplication;
use App\Models\Ref\RefGender;
use Livewire\Component;
use Livewire\WithPagination;

class Financing extends Component
{
    use WithPagination;

    public User $User;
    public AccountApplication $financing;
    public $gender;
    public $genderName;

    public function closeApplication()
    {
        $this->financing = new AccountApplication;
    }

    public function showApplication($uuid)
    {
        $this->financing = AccountApplication::where('uuid', $uuid)->with('customer')->first();
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

        $this->gender = RefGender::where('client_id', $this->User->client_id)->get();
    }

    public function render()
    {
        $financings = AccountApplication::where('client_id', $this->User->client_id)
        //->where('account_status','>','14')
        ->select('id','uuid','cust_id','apply_step','purchase_price','product_id','created_at','account_status')
        ->orderBy('created_at','desc')
        ->with('customer:id,name,identity_no')
        //->take(20)
        ->paginate(5);
        return view('livewire.page.application.application-list.financing',[
            'financings' => $financings,
        ]);
    }
}
