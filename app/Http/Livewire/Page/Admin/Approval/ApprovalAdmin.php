<?php

namespace App\Http\Livewire\Page\Admin\Approval;

use App\Models\CoopApproval;
use App\Models\CoopApprovalRole;
use App\Models\User;
use App\Models\CoopRoleGroup;
use Livewire\Component;

class ApprovalAdmin extends Component
{
    public User $User;
    public $approval;
    public $selected;
    public $custom;
    public $page;
    public $coopGroup   = [];
    public $lists       = [];

    protected $rules = [
        'lists.*.name'  => "nullable|max:50",
        'custom'        => "nullable|max:50",
    ];

    protected $validationAttributes = [
        'lists.*.name'  => 'Custom Name',
        'custom'        => 'Custom Name'
    ];

    public function mount($approval = 'Share')
    {
        if ( !in_array($approval,['Share','SellShare','Contribution'])){
            return redirect()->route('home');
        }
        $this->page      = $approval;
        $this->User      = User::find(Auth()->user()->id);

        $this->approval  = CoopApproval::firstOrCreate(['coop_id' => $this->User->coop_id, 'approval_type' => $approval]);
        $this->lists     = $this->approval->approvals()->orderBy('order')->get();
        $this->coopGroup = CoopRoleGroup::where('coop_id', $this->User->coop_id)->get();
    }

    public function add()
    {
        if($this->selected == ''){
            return '';
        }
        $last = $this->lists->count();
        $last++;
        $this->approval->approvals()->withTrashed()->updateOrCreate(
            [
                'order'   => $last,
                'coop_id' => $this->User->coop_id
            ],
            [
                'role_id'   => $this->selected,
                'deleted_at'=> NULL,
                'name'      => $this->custom,
            ]
        );
        $this->custom   = '';
        $this->lists    = $this->approval->approvals()->orderBy('order')->get();
        $this->save();
    }

    public function up($order)
    {
        if ($order > 1){
            $sort = $this->approval->approvals()->whereIn('order', [$order, $order-1])->orderBy('order')->get();
            $sort[0]->order = $order;
            $sort[1]->order = $order-1;
            $sort[0]->save();
            $sort[1]->save();
        }
        $this->lists    = $this->approval->approvals()->orderBy('order')->get();
    }

    public function down($order)
    {
        if ($order > 0){
            $sort = $this->approval->approvals()->whereIn('order', [$order, $order+1])->orderBy('order')->get();
            $sort[0]->order = $order+1;
            $sort[1]->order = $order;
            $sort[0]->save();
            $sort[1]->save();
        }
        $this->lists    = $this->approval->approvals()->orderBy('order')->get();
    }

    public function rem($id)
    {
        $rem   = CoopApprovalRole::where([['id', $id],['coop_id', $this->User->coop_id]])->firstOrFail();
        $rem->delete();
        $this->lists    = $this->approval->approvals()->orderBy('order')->get();
        foreach($this->lists as $key=>$list){
            if ($list->order != $key+1){
                $list->order = $key+1;
                $list->save();
            }
        }
        $this->lists    = $this->approval->approvals()->orderBy('order')->get();
    }

    public function deb()
    {
        $this->validate();
        dump([
            'share'     => $this->approval,
            'User'      => $this->User,
            'coopGroup' => $this->coopGroup,
            'lists'     => $this->lists,
            'selected'  => $this->selected,
            'list 0 name' => $this->lists[0]->name,
        ]);
    }

    public function save()
    {
        foreach($this->lists as $key=>$list){
            $list->save();
        }
    }

    public function render()
    {
        return view('livewire.page.admin.approval.approval-admin')->extends('layouts.head');
    }
}
