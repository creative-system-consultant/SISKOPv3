<?php

namespace App\Http\Livewire\Page\Application\ApplicationList;

use App\Models\Contribution as ApplyContribution;
use App\Models\Ref\RefBank;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class WithdrawalContribution extends Component
{
    use WithPagination;

    public User $User;
    public $withdraw;
    public $bankName;
    public $banks;
    public $route;

    public function clearApplication()
    {
        $this->withdraw = NULL;
    }

    public function showApplication($uuid)
    {
        $this->withdraw = ApplyContribution::where('uuid', $uuid)->with('customer')->first();
        $this->bankName = RefBank::where('client_id', $this->User->client_id)->get();
    }

    public function remake_approvals()
    {
        $this->withdraw->remove_approvals();
        $this->withdraw->make_approvals('SellContribution');
        $this->withdraw->flag = 1;
        $this->withdraw->step = 1;
        $this->withdraw->save();

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
        $this->User = User::find(auth()->user()->id);
        $this->banks = RefBank::where('client_id', $this->User->client_id)->get();
    }

    public function render()
    {
        if ($this->route == 'approval.list') {
            $withdrawal = ApplyContribution::where([['direction', 'withdraw'],['client_id', $this->User->client_id]])
                            ->where('flag', 1)
                            ->orderBy('created_at','desc')
                            ->with('customer')
                            ->paginate(5);
        } else {
            $withdrawal = ApplyContribution::where([['direction', 'withdraw'],['client_id', $this->User->client_id]])
                            ->where('flag', '!=', 0)
                            ->orderBy('created_at','desc')
                            ->with('customer')
                            ->paginate(5);
        }

        return view('livewire.page.application.application-list.withdrawal-contribution',[
            'withdrawal' => $withdrawal,
        ]);
    }
}
