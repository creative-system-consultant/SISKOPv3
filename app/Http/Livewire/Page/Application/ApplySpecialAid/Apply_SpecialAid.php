<?php

namespace App\Http\Livewire\Page\Application\ApplySpecialAid;

use App\Models\ApplySpecialAid;
use App\Models\Customer;
use App\Models\SpecialAid;
use Livewire\Component;

class Apply_SpecialAid extends Component
{
    public $customer_name;
    public $apply_amt;
    public $type_specialAid;
    public $specialAids;
    public $FspecialAid = [''];

    public function submit($uuid, $index)
    {

        $specialAids = SpecialAid::where([['uuid', $uuid], ['status', 1]])->first();

        $customer = Customer::where('coop_id', 1)->first();     
        
        $applySpecialAid = new ApplySpecialAid;

        if ($this->customer_name == '') {
            session()->now('nameError', 'Name is required'); 
        }

        if ($specialAids->min_apply_amt-1 >= $this->apply_amt[$index] || $specialAids->max_apply_amt+1 <= $this->apply_amt[$index]) {
            session()->now('errors','Apply amount must be in between RM '.$specialAids->min_apply_amt.' and RM '.$specialAids->max_apply_amt);        
        }
        else{
            if ($this->customer_name != '') {
                //  dd('Applied');
                $applySpecialAid->create([
                    'name'          => $this->customer_name,
                    'coop_id'       => $customer->coop_id,
                    'cust_id'       => $customer->id,
                    'step'          => 0,
                    'flag'          => 0,
                    'apply_amt'     => $this->apply_amt[$index],  
                    'approved_amt'  => NULL,
                ]);  
            }                                        
        }
        
        foreach ($specialAids->field as $key => $value) {
            if ($value->required === '1') {
                session()->now('warning', 'This field is required');                

                if (($this->FspecialAid[$key] ?? NULL) == NULL) {
                    session()->now('warning', 'This field is required');
                }
                else {
            
                    if ($this->customer_name != '') {
                    
                        session()->forget('warning');  
    
                        dd('Save');
                        $applySpecialAid->field()->create([
                            'name'    => $value->name,
                            'label'   => $value->label,
                            'type'    => $value->type,
                            'value'   => $this->FspecialAid[$key],
                        ]);                          
    
                        session()->flash('message', 'Special Aid Applied');
                        session()->flash('success');
                        session()->flash('title');
    
                        return redirect()->route('special-aid.apply');
                    }                                      
                }                            
            }      
            elseif($value->required === '0') {                
                if ($this->customer_name != '') {
                    // dd('Success');
                    $applySpecialAid->field()->create([
                        'name'    => $value->name,
                        'label'   => $value->label,
                        'type'    => $value->type,
                        'value'   => $this->FspecialAid[$key],
                    ]);

                    session()->flash('message', 'Special Aid Applied');
                    session()->flash('success');
                    session()->flash('title');

                    return redirect()->route('special-aid.apply');
                }
            }
        }    
    }

    public function mount()
    {
        $user = Auth()->user();
        
        $this->specialAids = SpecialAid::where([['coop_id', $user->coop_id], ['status', 1]])->get();
    
        foreach ($this->specialAids as $index => $specialAid) {
            $this->apply_amt[$index] = $specialAid->default_apply_amt;
        }
    }

    public function render()
    {
        return view('livewire.page.application.applySpecialAid.apply-special-aid')->extends('layouts.head');
    }
}
