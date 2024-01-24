<?php

namespace App\Http\Livewire\Page\Admin\Approval;

use App\Models\AccountProduct;
use App\Models\ClientApproval;
use App\Models\ClientApprovalRole;
use App\Models\User;
use App\Models\ClientRoleGroup;
use Illuminate\Support\Str;
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
    public $range;
    public $ranges;
    public $rule_vote_type = 'majority';
    public $firstMaker = false;
    public $isRule    = false;
    public $listview  = false;
    public $rangeview = false;
    public $coopGroup = [];
    public $lists     = [];

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
        'ranges.*.value1'       => "nullable",
        'ranges.*.value2'       => "nullable",
        'custom'                => "nullable|max:50",
        'product.id'            => "nullable",
    ];

    protected $validationAttributes = [
        'lists.*.name' => 'Custom Name',
        'custom'       => 'Custom Name',
        'product'      => 'Product',
    ];

    public function mount($product = NULL)
    {

        $this->product = AccountProduct::find($product);
        $this->product_id = $product;

        $this->page      = 'Financing';
        $this->User      = User::find(Auth()->user()->id);

        $this->products  = AccountProduct::where([['client_id', $this->User->client_id]])->select('id','name', 'product_type')->get();
        $this->approval  = ClientApproval::firstOrCreate(['client_id' => $this->User->client_id, 'approval_type' => 'Financing']);

        $this->coopGroup = ClientRoleGroup::where('client_id', $this->User->client_id)->get();
    }

    public function loadList()
    {
        if ($this->product_id != NULL){
            $this->lists     = $this->approval->approvals($this->product_id, $this->range)->orderBy('order')->get();
        }
    }

    public function add()
    {
        if($this->selected == ''){
            return '';
        }
        $last = $this->lists != [] ? $this->lists->count() : 1;
        $last++;
        $id = 
        $this->approval->approvals($this->product_id, $this->range)->withTrashed()->updateOrCreate(
            [
                'order'   => $last,
                'client_id' => $this->User->client_id
            ],
            [
                'product_range'=> $this->range,
                'min'       => $this->ranges[substr($this->range,-1)]['value1'],
                'max'       => $this->ranges[substr($this->range,-1)]['value2'],
                'product_id'=> $this->product_id,
                'role_id'   => $this->selected,
                'deleted_at'=> NULL,
            ]
        );
        $this->custom   = '';
        $this->lists    = $this->approval->approvals($this->product_id, $this->range)->orderBy('order')->get();
        //$adds->save();
    }

    public function up($order)
    {
        if ($order > 1){
            $sort = $this->approval->approvals($this->product_id, $this->range)->whereIn('order', [$order, $order-1])->orderBy('order')->get();
            $sort[0]->order = $order;
            $sort[1]->order = $order-1;
            $sort[0]->save();
            $sort[1]->save();
        }
        $this->lists    = $this->approval->approvals($this->product_id, $this->range)->orderBy('order')->get();
    }

    public function down($order)
    {
        if ($order > 0){
            $sort = $this->approval->approvals($this->product_id, $this->range)->whereIn('order', [$order, $order+1])->orderBy('order')->get();
            $sort[0]->order = $order+1;
            $sort[1]->order = $order;
            $sort[0]->save();
            $sort[1]->save();
        }
        $this->lists    = $this->approval->approvals($this->product_id, $this->range)->orderBy('order')->get();
    }

    public function rem($id)
    {
        $rem = ClientApprovalRole::where([['id', $id],['client_id', $this->User->client_id]])->firstOrFail();
        $rem->delete();
        $this->lists = $this->approval->approvals($this->product_id, $this->range)->orderBy('order')->get();
        foreach($this->lists as $key=>$list){
            if ($list->order != $key+1){
                $list->order = $key+1;
                $list->save();
            }
        }
        $this->lists = $this->approval->approvals($this->product_id, $this->range)->orderBy('order')->get();
    }

    public function deb()
    {
        $this->validate();
        dump([
            'product'   => $this->product,
            'financing' => $this->approval,
            'User'      => $this->User,
            'coopGroup' => $this->coopGroup,
            'lists'     => $this->lists,
            'selected'  => $this->selected,
            'range'     => $this->range,
            'ranges'    => $this->ranges,
            'approvals' => $this->approval->approvals($this->product_id)->where('order',1)->orderBy('order')->get(),
        ]);
    }

    public function setproduct()
    {
        $this->product = AccountProduct::find($this->product['id']);
        $this->product_id = $this->product->id;
        $this->range = '0';
        $this->ranges = NULL;
        $this->rangeview = true;
        $this->listview = false;

        $this->loadRanges();
    }

    public function loadRanges()
    {
        $lastkey = 0;
        $this->ranges = NULL;
        $load = $this->approval->approvals($this->product_id)->where('order',1)->orderBy('order')->get();

        if ($load->count() > 0){
            foreach($load as $key => $item)
            {
                $this->ranges[$key]['value1'] = $item->min;
                $this->ranges[$key]['value2'] = $item->max;
                $lastkey = $key;
            }
        } else {
            $this->ranges[0]['value1'] = $this->product->amt_min;
            $this->ranges[0]['value2'] = $this->product->amt_max;
        }
        $this->loadList();
        $this->listview = true;

        $this->ranges[0]['value1'] = $this->product->amt_min;
        $this->ranges[$lastkey]['value2'] = $this->product->amt_max;
        $this->changeRange($lastkey, $this->ranges[$lastkey]['value1'], $this->product->amt_max);
    }

    public function addRanges($index)
    {
        $mid = 0;
        $lastkey = 0;
        $this->listview = false;
        foreach($this->ranges as $key => $item)
        {
            $lastkey++;
            if ($key < $index){
                continue;
            } else if($key == $index) {
                $mid = ($this->ranges[$key]['value1'] + $this->ranges[$key]['value2'])/2;

                $this->ranges['temp']['value1'] = floor($mid+1);
                $this->ranges['temp']['value2'] = $this->ranges[$key]['value2'];
                $this->ranges[$key]['value2'] = floor($mid);
            } else {
                //
            }
        }
        $this->ranges[$lastkey]['value1'] = $this->ranges['temp']['value1'];
        $this->ranges[$lastkey]['value2'] = $this->ranges['temp']['value2'];
        unset($this->ranges['temp']);

        $this->range = $index+1;
        $this->loadList();
        $this->listview = true;

    }

    public function remRanges($index)
    {
        // 1. unset()
        // 2. array_values()
        // 3. array_key_last($this->ranges)

        foreach($this->ranges as $key => $item)
        {
            if ($key < $index){
                continue;
            } else if($key == $index) {
                $this->changeRange($key-1, $this->ranges[$key-1]['value1'], $this->ranges[$key]['value2']);

                $app = $this->approval->approvals($this->product_id, $key)->get();
                foreach($app as $item)
                {
                    $item->delete();
                }
            } else {
                $app = $this->approval->approvals($this->product_id, $key)->get();
                foreach($app as $item)
                {
                    $item->product_range = $key-1;
                    $item->save();
                }
            }
        }
        $this->range = NULL;
        $this->ranges = NULL;
        $this->loadRanges();
    }

    public function changeRange($key, $min, $max)
    {
        $app = $this->approval->approvals($this->product_id, $key)->get();
        foreach($app as $item)
        {
            $item->min = $min;
            $item->max = $max;
            $item->save();
        }
    }

    public function setproductrange()
    {
        if (
            $this->product_id != NULL &&
            $this->product_id != "" &&
            $this->range != NULL &&
            $this->range != ""
        ){
            $this->listview = true;
            $this->loadList();
        }
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

    public function updated($property, $value)
    {
        if (str_contains($property, 'ranges' )){
            $index = Str::between($property,'.','.');
            $range = substr($property,-1);

            if($range == 1){
                $val2 = $this->ranges[$index]['value1']-1;
                $this->ranges[$index-1]['value2'] = $val2;
                $this->changeRange($index, $val2+1, $this->ranges[$index]['value2']);
                $this->changeRange($index-1,$this->ranges[$index-1]['value1'], $val2);
            } else {
                $val1 = $this->ranges[$index]['value2']+1;
                $this->ranges[$index+1]['value1'] = $val1;
                $this->changeRange($index, $this->ranges[$index]['value1'], $val1-1);
                $this->changeRange($index+1, $val1, $this->ranges[$index+1]['value2']);
            }
        }
    }

    public function render()
    {
        return view('livewire.page.admin.approval.approval-financing')->extends('layouts.head');
    }
}
