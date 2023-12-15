<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;

class SellShare extends Component
{
    public User $User;
    public Share $sellShare;
    public $sellShares;
    public $banks;

    public function showApplication($uuid)
    {
        $this->sellShare = Share::where('uuid', $uuid)->with('customer')->first();
        $this->banks = RefBank::where('client_id', $this->sellShare->client_id)->get();
    }

    public function mount()
    {
        $this->User = User::find(auth()->user()->id);
        $this->sellShares = Share::where('direction', 'sell')->orWhere('direction', 'exchange')->orderBy('created_at','desc')->with('customer')->get();
    }

    public function render()
    {
        return view('livewire.page.application.application-list.sellshare');
    }
}
