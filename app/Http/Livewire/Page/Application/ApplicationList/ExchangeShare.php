<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Share as ExchangeShares;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ExchangeShare extends Component
{
    use WithPagination;
    public User $User;
    public ExchangeShares $ExchangeShares;
    public $route;
    public $filter = '';

    public function clearApplication()
    {
        $this->ExchangeShares = new ExchangeShares;
    }

    public function showApplication($uuid)
    {
        $this->ExchangeShares = ExchangeShares::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
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

    public function mount($route)
    {
        $this->route = $route;
        $this->User   = User::find(auth()->user()->id);
    }

    public function render()
    {
        if ($this->route == 'approval.list') {
            $shares = ExchangeShares::where([['direction', 'exchange'],['client_id', $this->User->client_id]])
                                    ->where('flag', 1)
                                    ->orderBy('created_at','desc')
                                    ->with('customer')
                                    ->paginate(5);
        } else {
            $sharesQuery = ExchangeShares::where([['direction', 'exchange'],['client_id', $this->User->client_id]])
                                                ->where('flag', '!=', 0);

            if ($this->filter == 'process') {
                $sharesQuery->where('flag', 1);
            } elseif ($this->filter == 'approved') {
                $sharesQuery->where('flag', 20);
            } elseif ($this->filter == 'failed') {
                $sharesQuery->where('flag', '>', 20);
            }

            $shares = $sharesQuery->orderBy('created_at', 'desc')
                                            ->with('customer')
                                            ->paginate(5);
        }

        return view('livewire.page.application.application-list.exchangeshare',[
            'shares' => $shares,
        ]);
    }
}
