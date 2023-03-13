<?php

namespace App\Http\Livewire\Page\Admin\Approval;

use App\Models\AccountProduct;
use App\Models\CoopApproval;
use App\Models\CoopApprovalRole;
use App\Models\User;
use App\Models\CoopRoleGroup;
use Livewire\Component;

class Financing extends Component
{
    public User $User;
    public $product;
    public $product_id;
    public $approval;
    public $products;
    public $selected;
    public $custom;
    public $page;
    public $firstMaker = false;
    public $isRule = false;
    public $coopGroup   = [];
    public $lists       = [];

    protected $rules = [
        'lists.*.name'          => "nullable|max:50",
        'lists.*.rule_min'      => "numeric",
        'lists.*.rule_max'      => "numeric",
        'lists.*.rule_employee' => "nullable",
        'lists.*.rule_whatsapp' => "nullable",
        'lists.*.rule_sms'      => "nullable",
        'lists.*.rule_email'    => "nullable",
        'custom'                => "nullable|max:50",
        'product.id'            => "nullable",
    ];

    protected $validationAttributes = [
        'lists.*.name'  => 'Custom Name',
        'custom'        => 'Custom Name',
        'product'       => 'Product',
    ];

    public function mount($product = NULL)
    {

        $this->product = AccountProduct::find($product);
        $this->product_id = $product;

        $this->page      = 'Financing';
        $this->User      = User::find(Auth()->user()->id);

        $this->products  = AccountProduct::where([['coop_id', $this->User->coop_id]])->select('id','name', 'product_type')->get();
        $this->approval  = CoopApproval::firstOrCreate(['coop_id' => $this->User->coop_id, 'approval_type' => 'Financing']);

        $this->loadList();

        $this->coopGroup = CoopRoleGroup::where('coop_id', $this->User->coop_id)->get();
    }

    public function loadList()
    {
        if ($this->product != NULL){
            $this->lists     = $this->approval->approvals($this->product_id)->orderBy('order')->get();
        }

    }

    public function add()
    {
        if($this->selected == ''){
            return '';
        }
        $last = $this->lists != [] ? $this->lists->count() : 1;
        $last++;
        $this->approval->approvals($this->product_id)->withTrashed()->updateOrCreate(
            [
                'order'   => $last,
                'coop_id' => $this->User->coop_id
            ],
            [
                'product_id'=> $this->product_id,
                'role_id'   => $this->selected,
                'deleted_at'=> NULL,
            ]
        );
        $this->custom   = '';
        $this->lists    = $this->approval->approvals($this->product_id)->orderBy('order')->get();
        //$adds->save();
    }

    public function up($order)
    {
        if ($order > 1){
            $sort = $this->approval->approvals($this->product_id)->whereIn('order', [$order, $order-1])->orderBy('order')->get();
            $sort[0]->order = $order;
            $sort[1]->order = $order-1;
            $sort[0]->save();
            $sort[1]->save();
        }
        $this->lists    = $this->approval->approvals($this->product_id)->orderBy('order')->get();
    }

    public function down($order)
    {
        if ($order > 0){
            $sort = $this->approval->approvals($this->product_id)->whereIn('order', [$order, $order+1])->orderBy('order')->get();
            $sort[0]->order = $order+1;
            $sort[1]->order = $order;
            $sort[0]->save();
            $sort[1]->save();
        }
        $this->lists    = $this->approval->approvals($this->product_id)->orderBy('order')->get();
    }

    public function rem($id)
    {
        $rem   = CoopApprovalRole::where([['id', $id],['coop_id', $this->User->coop_id]])->firstOrFail();
        $rem->delete();
        $this->lists    = $this->approval->approvals($this->product_id)->orderBy('order')->get();
        foreach($this->lists as $key=>$list){
            if ($list->order != $key+1){
                $list->order = $key+1;
                $list->save();
            }
        }
        $this->lists    = $this->approval->approvals($this->product_id)->orderBy('order')->get();
    }

    public function deb()
    {
        $this->validate();
        dump([
            'product'   => $this->product,
            'share'     => $this->approval,
            'User'      => $this->User,
            'coopGroup' => $this->coopGroup,
            'lists'     => $this->lists,
            'selected'  => $this->selected,
        ]);
    }

    public function setproduct()
    {
        $this->product = AccountProduct::find($this->product['id']);
        $this->product_id = $this->product->id;
        $this->loadList();
    }

    public function change_rule($id)
    {
        $this->isRule =! $this->isRule;
    }

    public function saveRule($key)
    {
        $this->lists[$key]->save();

    }

    public function render()
    {
        return view('livewire.page.admin.approval.approval-financing')->extends('layouts.head');
    }
}
