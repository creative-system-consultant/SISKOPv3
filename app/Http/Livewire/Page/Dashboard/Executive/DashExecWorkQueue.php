<?php

namespace App\Http\Livewire\Page\Dashboard\Executive;

use App\Models\AccountApplication;
use App\Models\ClientApprovalRole;
use App\Models\Ref\RefApprovalType;
use App\Models\User;
use App\Models\UserGroup;
use Livewire\Component;

class DashExecWorkQueue extends Component
{
    public User $User;
    public $approval_type;
    public $approval_role = [];
    public $financing = [];
    public $group;

    public function mount()
    {
        $this->User             = User::find(auth()->user()->id);
        $this->group            = UserGroup::where('user_id', $this->User->id)->orderBy('grouping_id')->get();
        $this->approval_type    = RefApprovalType::where('status',1)->get();
        foreach ($this->group as $key => $value) {
            $this->approval_role[$key+1] = ClientApprovalRole::where([['client_id', $this->User->client_id],['role_id', $value->grouping_id]])->get();
            foreach ($this->approval_role[$key+1] as $key1 => $value1) {
                $accounts = AccountApplication::where([
                                    ['client_id', $this->User->client_id],
                                    ['apply_step', $value1->order],
                                    //['product_id', ]
                            ])->get();
                $this->financing[$value1->role_id] = $accounts ?? NULL;
            }
        }
        /*
        dd([
            'user'  => $this->User,
            'group' => $this->group,
            //'type' => $this->approval_type,
            'role' => $this->approval_role,
            //'financing' => $this->financing
        ]);
        */
    }

    public function render()
    {
        return view('livewire.page.dashboard.executive.dash-exec-work-queue');
    }
}
