<?php

namespace App\Http\Livewire\Page\Application\ApplySpecialAid;

use App\Models\ApplySpecialAid as ModelApplySpecialAid;
use App\Models\Customer;
use App\Models\SpecialAid;
use Illuminate\Support\MessageBag;
use Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ApplySpecialAid extends Component
{
    use WithFileUploads;

    public $customer_name;
    public $apply_amt;
    public $online_file;
    public $event_date;
    public $type_specialAid;
    public $specialAids;
    public $user;
    public $customer;
    public $identity_no;
    public $FspecialAid = [''];

    public function submit($uuid, $index)
    {


        $specialAids = SpecialAid::where([['uuid', $uuid], ['status', 1]])->first();

        if ($this->customer_name == '') {
            session()->flash('nameError', 'Name is required');
            return back();
        }

        if (($this->apply_amt[$index] ?? NULL) == NULL) {
            session()->flash('errors', 'Apply Amount is required');
            return back();
        } elseif ($specialAids->min_apply_amt - 1 >= $this->apply_amt[$index] || $specialAids->max_apply_amt + 1 <= $this->apply_amt[$index]) {
            session()->flash('errors', 'Apply amount must be in between RM ' . $specialAids->min_apply_amt . ' and RM ' . $specialAids->max_apply_amt);
            return back();
        } elseif (($this->event_date[$index] ?? NULL) == NULL) {
            session()->flash('errorDate', 'You must pick the event date');
            return back();
        } elseif ($this->online_file == null) {
            session()->flash('errorFile', 'You must upload a supporting document');
            return back();
        } else {

            $applySpecialAid = ModelApplySpecialAid::create([
                'name'              => $this->customer_name,
                'client_id'         => $this->customer->client_id,
                'cust_id'           => $this->customer->id,
                'special_aid_id'    => $this->type_specialAid,
                'step'              => 1,
                'flag'              => 1,
                'apply_amt'         => $this->apply_amt[$index],
                'apply_date'        => now(),
                'event_date'        => $this->event_date[$index],
                'approved_amt'      => NULL,
                'created_by'        => strtoupper($this->customer->name)
            ]);

            $filepath = 'Files/' . $this->customer->id . '/specialaid//' . $applySpecialAid->id . '/' . 'special_aid_document' . '.' . $this->online_file->extension();

            Storage::disk('local')->putFileAs('public/Files/' . $this->customer->id . '/specialaid//' . $applySpecialAid->id . '/', $this->online_file, 'special_aid_document' . '.' . $this->online_file->extension());

            $applySpecialAid->files()->create([
                'filename' => 'special_aid_document',
                'filedesc' => 'Special Aid Document',
                'filetype' => $this->online_file->extension(),
                'filepath' => $filepath,
            ]);

            $applySpecialAid->remove_approvals();
            $applySpecialAid->make_approvals('SpecialAid');
        }


        session()->flash('message', 'Special Aid Applied');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('special-aid.apply');
    }

    public function mount()
    {
        $this->user = auth()->user();
        $this->specialAids = SpecialAid::where([['client_id', $this->user->client_id], ['status', 1]])->get();
        $this->customer = Customer::where('identity_no', $this->user->icno)->where('client_id', $this->user->client_id)->first();

        $this->customer_name = $this->customer->name;
        $this->identity_no = $this->customer->identity_no;

        foreach ($this->specialAids as $index => $specialAid) {
            $this->apply_amt[$index] = $specialAid->default_apply_amt;
        }
    }

    public function render()
    {
        return view('livewire.page.application.applySpecialAid.apply-special-aid')->extends('layouts.head');
    }
}
