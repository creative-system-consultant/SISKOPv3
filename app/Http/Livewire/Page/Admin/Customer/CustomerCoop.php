<?php

namespace App\Http\Livewire\Page\Admin\Customer;

use App\Models\Coop;
use App\Models\CustomField;
use Livewire\Component;

class CustomerCoop extends Component
{
    public Coop $Coop;
    public $field;
    public $Fname  = [];
    public $Flabel = [];
    public $Ftype  = [];

    protected $rules    = [];
    protected $messages = [];
    protected $validationAttributes = [];

    public function mount(){
        $this->Coop     = Coop::where('id', Auth()->user()->client_id)->firstOrFail();
        $this->field    = new CustomField;

        foreach ($this->Coop->fields as $item) {
            $this->Fname[]  = $item->name;
            $this->Flabel[] = $item->label;
            $this->Ftype[]  = $item->type;
        }
    }

    public function addField()
    {
        $this->Fname[]  = '';
        $this->Flabel[] = '';
        $this->Ftype[]  = '';
    }

    public function remField($index)
    {
        unset($this->Fname[$index]);
        unset($this->Flabel[$index]);
        unset($this->Ftype[$index]);
        $this->Fname  = array_values($this->Fname);
        $this->Flabel = array_values($this->Flabel);
        $this->Ftype  = array_values($this->Ftype);

        if(isset($this->Coop->fields[$index])){
            $this->Coop->fields[$index]->delete();
        }
    }

    public function submit(){
        foreach ($this->Fname as $index => $name) {
            $this->Coop->fields()->updateOrCreate([
                'name'      => $this->Fname[$index],
            ],[
                'label'     => $this->Flabel[$index],
                'type'      => $this->Ftype[$index] ?? 'string',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.page.admin.customer.customer-coop')->extends('layouts.head');
    }
}
