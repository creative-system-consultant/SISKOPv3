<?php

namespace App\Http\Livewire\Admin\maintenance\marital;

use Livewire\Component;
use App\Models\Ref\RefMarital;

class CreateMarital extends Component
{
    public $marital_description;
    public $marital_code;
    public $marital_status;
    public $marital;

    public function submit()
    {
        $this->validate([
            'marital_description' => ['required', 'string'],
            'marital_code'        => ['required', 'string'],
        ]);

        $marital = RefMarital::create([
            'description' => $this->marital_description,
            'code'        => $this->marital_code,
            'status'      => $this->marital_status == true ? '1' : '0',
        ]);

        session()->flash('message', 'Marital Created');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('marital.list');
    }

    public function render()
    {
        return view ('maintenance.marital.create')->extends('layouts.head');
    }
}
