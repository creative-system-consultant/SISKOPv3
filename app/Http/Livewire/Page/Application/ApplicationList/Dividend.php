<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\ApplyDividend;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Dividend extends Component
{
    use WithPagination;
    public User $User;
    public ApplyDividend $dividend;

    public function clearApplication()
    {
        $this->dividend = new ApplyDividend;
    }

    public function showApplication($uuid)
    {
        $this->dividend = ApplyDividend::where('uuid', $uuid)->with('customer')->first();
    }

    public function mount()
    {
        $this->User      = User::find(auth()->user()->id);
    }

    public function render()
    {
        $dividends = ApplyDividend::where([['client_id', $this->User->client_id]])->orderBy('created_at','desc')->with('customer')->paginate(5);
        return view('livewire.page.application.application-list.dividend',[
            'dividends' => $dividends,
        ]);
    }
}
