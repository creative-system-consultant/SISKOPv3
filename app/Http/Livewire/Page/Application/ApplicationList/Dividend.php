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
    public $route;

    public function clearApplication()
    {
        $this->dividend = new ApplyDividend;
    }

    public function showApplication($uuid)
    {
        $this->dividend = ApplyDividend::where('uuid', $uuid)->with('customer')->first();
    }

    public function remake_approvals()
    {
        $this->dividend->remove_approvals();
        $this->dividend->make_approvals();
        $this->dividend->step = 1;
        $this->dividend->save();

        $this->dispatchBrowserEvent('swal',[
            'title' => 'Success!',
            'text'  => 'Approvals have been reset',
            'icon'  => 'success',
            'showConfirmButton' => false,
            'timer' => 360000,
        ]);
    }

    public function mount($route)
    {
        $this->route = $route;
        $this->User      = User::find(auth()->user()->id);
    }

    public function render()
    {
        if ($this->route == 'approval.list') {
            $dividends = ApplyDividend::where([['client_id', $this->User->client_id]])
                                        ->where('flag', 1)
                                        ->orderBy('created_at','desc')
                                        ->with('customer')
                                        ->paginate(5);
        } else {
            $dividends = ApplyDividend::where([['client_id', $this->User->client_id]])
                                        ->where('flag', '!=', 0)
                                        ->orderBy('created_at','desc')
                                        ->with('customer')
                                        ->paginate(5);
        }

        return view('livewire.page.application.application-list.dividend',[
            'dividends' => $dividends,
        ]);
    }
}
