<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Share as ExchangeShares;
use App\Models\User;
use Livewire\Component;

class ExchangeShare extends Component
{
    public User $User;
    public ExchangeShares $share;
    public $shares;

    public function clearApplication()
    {
        $this->share = new ExchangeShares;
    }

    public function showApplication($uuid)
    {
        $this->share = ExchangeShares::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
    }

    public function remake_approvals()
    {
        $this->share->remove_approvals();
        $this->share->make_approvals('ExchangeShare');
        $this->share->step = 1;
        $this->share->save();

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
        $this->User   = User::find(auth()->user()->id);
        $this->shares = ExchangeShares::where([['direction', 'exchange'],['client_id', $this->User->client_id]])->orderBy('created_at','desc')->with('customer')->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.share');
    }
}
