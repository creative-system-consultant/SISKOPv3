<?php

namespace App\Http\Livewire\Page\Admin\Maintenance\Financing;

use Livewire\Component;
use App\Models\Ref\RefFinCalcType;

class CalculationTypeList extends Component
{
    public $RefCalcType;

    public function mount()
    {
        $this->RefCalcType = RefFinCalcType::all();
    }

    public function delete($id)
    {
        $data=RefFinCalcType::find($id);
        $data->delete();

        session()->flash('message', 'Calculation Type Record Deleted');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('calculationType.list');
    }

    public function render()
    {
        return view('livewire.admin.maintenance.financing.calculation_type')->extends('layouts.head');
    }
}

