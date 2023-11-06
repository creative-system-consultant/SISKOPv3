<?php

namespace App\Http\Livewire\Page\Admin\Membership;

use App\Models\FieldMaster;
use App\Models\Membership;
use App\Models\MembershipField;
use App\Models\MembershipDocument;
use App\Models\Ref\RefMembershipDocument;
use App\Models\User;
use Livewire\Component;

class MembershipAdmin extends Component
{
    public User $User;
    public Membership $membership;
    public $field = [];
    public $document = [];
    public $refdocument;
    public $documentlist = [];
    protected $rules    = [];
    protected $messages = [];
    protected $validationAttributes = [];

    public function mount(){
        $this->User = auth()->user();

        $this->membership = Membership::firstOrCreate([
            'client_id'       => $this->User->client_id,
        ],[
            'created_by'    => $this->User->name,
        ]);

        $this->refdocument = RefMembershipDocument::where('client_id', $this->User->client_id)->get();
        //$this->documentlist = $this->membership->documents;
    }

    public function enableFn($id)
    {
        $field = MembershipField::firstOrCreate([
            'membership_id' => $this->membership->id,
            'client_id'       => $this->User->client_id,
            'field_id'      => $id,
        ]);

        $field->update([
            'status'    => !$field->status,
        ]);
    }
    public function enableDoc($code,$name)
    {
        $document = MembershipDocument::firstOrCreate([
            'membership_id' => $this->membership->id,
            'client_id'       => $this->User->client_id,
            'type'          => $code,
            'name'          => $name,
        ]);

        $document->update([
            'status'    => !$document->status,
        ]);
    }



    public function submit(){

    }

    public function render()
    {
        return view('livewire.page.admin.membership.membership-admin')->extends('layouts.head');
    }
}
