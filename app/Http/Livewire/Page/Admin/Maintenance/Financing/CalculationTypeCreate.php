<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Financing;

use App\Models\Ref\RefFinCalcType;
use App\Models\User;
use Livewire\Component;

class CalculationTypeCreate extends Component
{
    public User $User;
    public RefFinCalcType $RefCalcType;
    public $status;
    public $page = 'Create';

    protected $rules = [
        'RefCalcType.description' => ['required', 'string'],
        'RefCalcType.code'        => ['required', 'string'],
        'status'                  => ['nullable'],
    ];

    public function submit()
    {
        $this->validate();

        $this->RefCalcType->description = trim(strtoupper($this->RefCalcType->description));
        $this->RefCalcType->code        = trim(strtoupper($this->RefCalcType->code));
        $this->RefCalcType->client_id   = $this->User->client_id;
        $this->RefCalcType->status      = $this->status == true ? '1' : '0';
        $this->RefCalcType->save();

        session()->flash('message', 'Calculation Type SAVED');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('calculationType.list');
    }

    public function deb() {
        dd([
            'RefCalcType' => $this->RefCalcType,
            'status'      => $this->status,
        ]);
    }

    public function mount($id = NULL)
    {
        $this->User = User::find(auth()->user()->id);
        if ($id != NULL){
            $this->RefCalcType = RefFinCalcType::find($id);
            $this->status      = $this->RefCalcType->status == '1' ? TRUE : NULL;
        } else {
            $this->RefCalcType = new RefFinCalcType;
            $this->RefCalcType->client_id  = $this->User->client_id;
            $this->RefCalcType->created_by = $this->User->name;
            $this->page = 'Edit';
        }
    }

    public function render()
    {
        return view('livewire.admin.maintenance.financing.calculation_type_create')->extends('layouts.head');
    }
}