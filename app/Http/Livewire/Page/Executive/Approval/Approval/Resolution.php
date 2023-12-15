<?php

namespace App\Http\Livewire\Page\Executive\Approval\Approval;

use App\Models\Approval;
use App\Models\Contribution;
use App\Models\Share;
use App\Models\Ref\RefBank;
use App\Models\User;
use Livewire\Component;

class Resolution extends Component
{
    public User $User;
    public Approval $Approval;
    public $Application;

    public $approval_type = 'lulus';
    public $banks = [];
    public $disable = 'readonly';
    public $flag = 20;
    public $forward = false;
    public $include = '';
    public $message = 'Application Approved';
    public $page = 0;
    public $pagename = '';
    public $pagetype = '';
    public $vote = 'Suggest';

    protected function rules()
    {
        $rules = [
            'Approval.note' => 'required|max:255',
        ];

        return array_merge($rules,$this->custom_rule[$this->include]['rule']);
    }

    protected $custom_rule = [
                    'share' => [
                            'name' => 'Buy Share',
                            'type' => 'App\Models\Share',
                            'page' => 2,
                            'rule' => [
                                'Application.approved_amt' => 'required|gt:0',
                                'Application.bank_code' => 'required',
                            ],
                        ],
                    'sellshare' => [
                            'name' => 'Sell Share',
                            'type' => 'App\Models\Share',
                            'page' => 3,
                            'rule' => [
                                //'Application.approved_amt' => 'required|gt:0',
                            ],
                        ],
                    'contribution' => [
                            'name' => 'Add Contribution',
                            'type' => 'App\Models\Contribution',
                            'page' => 4,
                            'rule' => [
                                'Application.approved_amt' => 'required|gt:0',
                            ],
                        ],
                    'sellcontribution' => [
                            'name' => 'Withdrawal Contribution',
                            'type' => 'App\Models\Contribution',
                            'page' => 5,
                            'rule' => [
                                'Application.approved_amt' => 'required|gt:0',
                            ],
                        ],
                ];

    public function forward() {
        // $this->validate();
        // $this->approval_type = 'Send to next level';
        // $this->message       = 'Application send to next level';
        // $this->next();
    }

    public function decline() {
        $this->validate();
        $this->flag = 23;
        $this->approval_type = 'gagal';
        $this->message       = 'Application declined';
        $this->next();
    }

    public function next()
    {
        $this->Application->flag = $this->flag;
        $this->Application->save();
        $this->Approval->user_id = $this->User->id;
        $this->Approval->type = $this->approval_type;
        $this->Approval->save();

        session()->flash('message', $this->message);
        session()->flash('success');
        session()->flash('time', 10000);
        session()->flash('title', 'Success!');

        return redirect()->route('application.list',['page' => $this->custom_rule[$this->include]['page']]);
    }

    public function back()
    {
        if ($this->Application->step > 1){
            $this->Application->step--;
            $this->Application->save();

            session()->flash('message', 'Application Backtracked');
            session()->flash('success');
            session()->flash('time', 10000);
            session()->flash('title', 'Success!');

            return redirect()->route('application.list',['page' => $this->custom_rule[$this->include]['page']]);
        } else {
            $this->dispatchBrowserEvent('swal',[
                'title' => 'Error!',
                'text'  => 'No previous step, this is the first Approval step.',
                'icon'  => 'error',
                'showConfirmButton' => false,
                'timer' => 10000,
            ]);
        }
    }

    public function deb()
    {
        dd([
            'User' => $this->User->role_ids(),
            'Approval' => $this->Approval,
            'current_Approval' => $this->Application->current_approval(),
            'Application' => $this->Application,
            'rules' => $this->rules(),
            'include' => $this->custom_rule[$this->include]['rule'],
        ]);
    }

    public function notfound(){
        session()->flash('message', 'Application does not exist');
        session()->flash('warning');
        session()->flash('time', 10000);
        session()->flash('title', 'Warning!');
    }

    public function mount($uuid, $include)
    {
        if (!in_array($include, ['share','sellshare','contribution','sellcontribution'])){
            $this->notfound();
            return redirect()->route('application.list');
        }
        $this->include  = $include;
        $this->page     = $this->custom_rule[$this->include]['page'] ?? '';
        $this->pagename = $this->custom_rule[$this->include]['name'] ?? '';
        $this->pagetype = $this->custom_rule[$this->include]['type'] ?? '';
        $this->User     = User::find(auth()->user()->id);
        if ($this->include == 'contribution' || $this->include == 'sellcontribution'){
            $this->Application = Contribution::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else if ($this->include == 'share' || $this->include == 'sellshare'){
            $this->Application = Share::where('uuid', $uuid)->where('client_id', $this->User->client_id)->with('customer')->first();
        } else {
            // || in_array($this->Application->current_approval()?->group_id,$this->User->role_ids())
        }
        if ($this->Application == NULL ){
            $this->notfound();
            return redirect()->route('application.list',['page' => $this->custom_rule[$this->include]['page']]);
        }

        $this->Approval = Approval::where([
            ['approval_id', $this->Application->id],
            ['order', $this->Application->step],
            ['role_id', '2'],
            ['approval_type', $this->pagetype ],
        ])->whereNull('type')->firstOrFail();

        //$this->forward = $this->Approval->rule_forward ?? FALSE;
        $this->banks = RefBank::where('client_id', $this->Application->client_id)->where('status', '1')->orderby('priority','asc')->orderby('description')->get();
    }

    public function render()
    {
        return view('livewire.page.executive.approval.approval.approval')->extends('layouts.head');
    }
}
