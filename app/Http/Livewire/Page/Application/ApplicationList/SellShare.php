<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Ref\RefBank;
use App\Models\Share;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class SellShare extends Component
{
    use WithPagination;

    public User $User;
    public Share $sellShare;
    public $client_id;
    public $banks;
    public $route;
    public $filter = '';

    public function showApplication($uuid)
    {
        $this->sellShare = Share::where('uuid', $uuid)->with('customer')->first();
        $this->banks = RefBank::where('client_id', $this->sellShare->client_id)->get();
    }

    public function mount($route)
    {
        $this->route = $route;
        $this->User = User::find(auth()->user()->id);
        $this->client_id = $this->User->client_id;
    }

    public function render()
    {
        if ($this->route == 'approval.list') {
            $sellShares = Share::where('client_id', $this->client_id)
                                ->where('direction', 'sell')
                                ->where('flag', 1)
                                ->orderBy('created_at','desc')
                                ->with('customer')
                                ->paginate(5);
        } else {
            $sellSharesQuery = Share::where('client_id', $this->client_id)
                                        ->where('direction', 'sell')
                                        ->where('flag', '!=', 0);

            if ($this->filter == 'process') {
                $sellSharesQuery->where('flag', 1);
            } elseif ($this->filter == 'approved') {
                $sellSharesQuery->where('flag', 20);
            } elseif ($this->filter == 'failed') {
                $sellSharesQuery->where('flag', '>', 20);
            }

            $sellShares = $sellSharesQuery->orderBy('created_at', 'desc')
                                            ->with('customer')
                                            ->paginate(5);
        }

        return view('livewire.page.application.application-list.sellshare',[
            'sellShares' => $sellShares,
        ]);
    }
}
