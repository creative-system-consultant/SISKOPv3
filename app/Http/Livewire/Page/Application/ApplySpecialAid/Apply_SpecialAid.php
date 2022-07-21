<?php

namespace App\Http\Livewire\Page\Application\ApplySpecialAid;

use App\Models\ApplySpecialAid;
use App\Models\Customer;
use App\Models\SpecialAid;
use Illuminate\Support\MessageBag;
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
        $user = auth()->user();
        $specialAids = SpecialAid::where([['uuid', $uuid], ['status', 1]])->first();
        $customer = Customer::where('icno', $user->icno)->first();         

        if ($this->customer_name == '') {
            session()->flash('nameError', 'Name is required'); 
            return back();
        }
        
        if(($this->apply_amt[$index] ?? NULL) == NULL) {
            session()->flash('errors', 'Apply Amount is required');
            return back();
        }
        elseif ($specialAids->min_apply_amt-1 >= $this->apply_amt[$index] || $specialAids->max_apply_amt+1 <= $this->apply_amt[$index]) {
            session()->flash('errors','Apply amount must be in between RM '.$specialAids->min_apply_amt.' and RM '.$specialAids->max_apply_amt);   
            return back();
        }
        else{
            $applySpecialAid = ApplySpecialAid::create([
                'name'              => $this->customer_name,
                'coop_id'           => $customer->coop_id,
                'cust_id'           => $customer->id,
                'special_aid_id'    => $this->type_specialAid,
                'step'              => 1,
                'flag'              => 1,
                'apply_amt'         => $this->apply_amt[$index],  
                'approved_amt'      => NULL,
                'created_by'        => strtoupper($customer->name)
            ]);                                        
        }

        foreach ($specialAids->field  as $key => $value) {
            if ($value->required == '1') {         
                if (($this->FspecialAid[$key] ?? NULL) == NULL) {                    
                    session()->flash('warning', 'This field is required');
                    return back();
                }
                else {                               
                    session()->forget('warning');

                    $vals = $this->FspecialAid[$key];

                    if ($value->type == 'date') {
                        $vals = date_format(date_create($this->FspecialAid[$key]),'Y/m/d');
                    }

                    $applySpecialAid->field()->create([
                        'name'       => $value->name,
                        'label'      => $value->label,
                        'type'       => $value->type,
                        'value'      => $vals,
                        'created_by' => strtoupper($customer->name)
                    ]);                                                                   
                }                            
            }      
            elseif($value->required == '0') {                
                $applySpecialAid->field()->create([
                    'name'       => $value->name ?? NULL,
                    'label'      => $value->label ?? NULL,
                    'type'       => $value->type ?? NULL,
                    'value'      => $this->FspecialAid[$key] ??= NULL,
                    'created_by' => strtoupper($customer->name) ?? NULL
                ]);                                
            }
        }    

        $applySpecialAid->notification()->create([
            'title'       => 'Special Aid is being processed',
            'type'        =>  3,
            'description' => 'Your Application has been sent',
            'link'        => url('/applySpecialAid'),
        ]);

        session()->flash('message', 'Special Aid Applied');
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('special-aid.apply');
        
    }

    public function mount()
    {
        $user = auth()->user();    
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
