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
    public $product;
    public $product_id;
    public $approval;
    public $products;
    public $selected;
    public $custom;
    public $page;
    public $rule_vote_type = 'majority';
    public $firstMaker = false;
    public $isRule = false;
    public $coopGroup   = [];
    public $lists       = [];

    protected $rules = [
        'lists.*.name'          => "nullable|max:50",
        'lists.*.rule_min'      => "numeric",
        'lists.*.rule_max'      => "numeric",
        'lists.*.rule_vote'     => "nullable",
        'lists.*.rule_forward'  => "nullable",
        'lists.*.rule_employee' => "nullable",
        'lists.*.rule_whatsapp' => "nullable",
        'lists.*.rule_sms'      => "nullable",
        'lists.*.rule_email'    => "nullable",
        'custom'        => "nullable|max:50",
    ];

    protected $validationAttributes = [
        'lists.*.name'  => 'Custom Name',
        'custom'        => 'Custom Name',
    ];

    public function mount($type = 'Share')
    {
        if ( !in_array($type,['Share','SellShare','Contribution','SellContribution','Membership','Apply_Dividend'])){
            return redirect()->route('home');
        }

        $this->page      = $type;
        $this->User      = User::find(Auth()->user()->id);

        $this->approval  = CoopApproval::firstOrCreate(['client_id' => $this->User->client_id, 'approval_type' => $type]);

        $this->loadList();

        $this->coopGroup = CoopRoleGroup::where('client_id', $this->User->client_id)->get();
    }

    public function loadList()
    {
        $this->lists     = $this->approval->approvals()->orderBy('order')->get();

    }

    public function add()
    {
        if($this->selected == ''){
            return '';
        }
        $last = $this->lists != [] ? $this->lists->count() : 1;
        $last++;
        $this->approval->approvals()->withTrashed()->updateOrCreate(
            [
                'order'   => $last,
                'client_id' => $this->User->client_id
            ],
            [
                'role_id'   => $this->selected,
                'deleted_at'=> NULL,
            ]
        );
        $this->custom   = '';
        $this->lists    = $this->approval->approvals()->orderBy('order')->get();
        //$adds->save();
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
        $rem   = CoopApprovalRole::where([['id', $id],['client_id', $this->User->client_id]])->firstOrFail();
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
        ]);
    }

    public function change_rule($id)
    {
        $this->rule_vote_type = $this->lists[$id-1]->rule_vote_type;
    }

    public function saveRule($key)
    {
        if($this->rule_vote_type == 'majority'){
            $this->lists[$key]->rule_vote = FALSE;
        } else {
            $this->lists[$key]->rule_vote = TRUE;
        }
        $this->lists[$key]->rule_vote_type = $this->rule_vote_type;
        $this->lists[$key]->save();

    }

    public function render()
    {
        return view('livewire.page.admin.approval.approval-admin')->extends('layouts.head');
    }
}
