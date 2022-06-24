<?php

namespace App\Http\Livewire\Admin\SpecialAid;

use App\Models\SpecialAid;
use App\Models\SpecialAidField;
use Livewire\Component;

class EditSpecialAid extends Component
{
    public $field;
    public $specialAid_name;
    public $enabled_apply_amt;
    public $default_apply_amount;
    public $specialAid;
    public $Fname  = [''];
    public $Flabel = [''];
    public $Ftype  = [''];
    public $Fstatus = [''];
    public $Fuuid = [''];

    //Need protected $listerners to run the Livewire.emit event
    protected $listeners = ['remField'];

    public function createField()
    {
        $this->Fname[]  = '';
        $this->Flabel[] = '';
        $this->Ftype[]  = '';
    }

    public function alertDelete($uuid, $index)
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'type'      => 'warning',  
            'text'      => 'Are you sure?', 
            'uuid'      => $uuid,
            'index'     => $index,
        ]);
    }

    public function remField($uuid, $index)
    {
        $specialAid = SpecialAid::where('uuid', $uuid)->first();
 
        $Fdelete = $specialAid->field()->where('uuid', $this->Fuuid[$index])->first();
        $Fdelete->delete();

        return redirect()->route('special_aid.edit', $uuid);
    }


    public function submit($uuid)
    {
        // dd($this->Fstatus);     
        $specialAid = SpecialAid::where('uuid', $uuid)->first();

        $this->validate([
            'specialAid_name'       => ['required', 'string'],
            'default_apply_amount'  => ['required', 'numeric'],
            'Fname.*'               => ['required', 'min:4'],
            'Flabel.*'              => ['required', 'min:4'],
        ]);
        
        $specialAid->update([
            'name'               => $this->specialAid_name,
            'apply_amt_enable'   => $this->enabled_apply_amt == true ? '1' : '0',
            'default_apply_amt'  => $this->default_apply_amount,
        ]);
                
        foreach ($this->Fname as $index => $input) {  
            if (($this->Fuuid[$index] ?? NULL) == NULL){
                $specialAid->field()->create([
                        'name'      => $this->Fname[$index],
                        'label'     => $this->Flabel[$index],
                        'type'      => $this->Ftype[$index] == '' ? 'string' : $this->Ftype[$index],
                ]);                         
            } else {
                $specialAid->field()->updateOrCreate([
                        'uuid'      =>  $this->Fuuid[$index],
                    ],[
                        'name'      => $this->Fname[$index],
                        'label'     => $this->Flabel[$index],
                        'type'      => $this->Ftype[$index]  == '' ? 'string' : $this->Ftype[$index],
                ]);
            }
        }

        session()->flash('message', 'Special Aid Updated');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('special_aid.list');
    }

    public function  loadUser($uuid)
    {
        $specialAid = SpecialAid::where('uuid', $uuid)->first();          

        $this->specialAid_name      = $specialAid->name;
        $this->default_apply_amount = $specialAid->default_apply_amt;
        $this->enabled_apply_amt    = $specialAid->apply_amt_enable == true ? 'checked' : '';
        
        foreach ($specialAid->field as $index => $input) {                      
            $this->Flabel[$index]  = $input->label;
            $this->Fname[$index]   = $input->name;
            $this->Ftype[$index]   = $input->type;
            $this->Fuuid[$index]   = $input->uuid;
            $this->Fstatus[$index] = $input->status == '1' ? true : false;
        }   
    }

        public function mount($uuid)
    {
        $this->specialAid = SpecialAid::where('uuid', $uuid)->first();

        $this->field = new SpecialAidField;

        $this->loadUser($uuid);
    }

    public function render()
    {
        return view('livewire.admin.special-aid.edit-special-aid')->extends('layouts.head');
    }
}
