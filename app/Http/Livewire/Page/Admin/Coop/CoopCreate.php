<?php

namespace App\Http\Livewire\Page\Admin\Coop;

use App\Models\Address;
use App\Models\Coop;
use App\Models\CoopAdmin;
use App\Models\Ref\RefState;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class CoopCreate extends Component
{
    use WithFileUploads;

    public Coop $coop;
    public Address $address;
    public User $admin;
    public User $User;
    public $ids    = [];
    public $idrem  = [];
    public $search = '';
    public $users  = [];
    public $userList = [];
    public $states;
    public $selected;
    public $logo;
    public $page = 'Create';

    protected $rules    = [
        'coop.name'         => 'required|min:6|max:255',
        'coop.name2'        => 'required|min:3|max:255',
        'coop.reg_num'      => 'required|min:3|max:255',
        'coop.type_id'      => 'required|integer',
        'coop.description'  => 'max:255',
        'coop.status'       => 'required|',
        'address.address1'  => 'required|max:255',
        'address.address2'  => 'required|max:255',
        'address.address3'  => 'max:255',
        'address.town'      => 'required|max:255',
        'address.postcode'  => 'required|integer|digits:5',
        'address.def_state_id'=> 'required|integer',
        'search'            => 'nullable|max:255',
        'logo'              => 'nullable|image|max:5120'             //filesize max 5mb
    ];
    protected $messages = [
        'coop.name.required'            => 'You must specify name ',
        'coop.name2.required'           => 'You must specify abbreviation ',
        'coop.reg_num.required'         => 'You must specify registration number ',
        'coop.type_id.required'         => 'You must select Type of Organization ',
        'address.address1.required'     => 'You must specify Address Line 1 & 2',
        'address.address2.required'     => 'You must specify Address Line 1 & 2',
        'address.town.required'         => 'You must specify Town',
        'address.postcode.required'     => 'You must specify Postcode',
        'address.def_state_id.required' => 'You must specify State',
    ];
    protected $validationAttributes = [
        'coop.name'             => 'Organization Name',
        'coop.name2'            => 'Organization Abbreviation',
        'coop.type_id'          => 'Organization Type',
        'address.address1'      => 'Address line 1',
        'address.address2'      => 'Address line 2',
        'address.town'          => 'Town',
        'address.postcode'      => 'Postcode',
        'address.def_state_id'  => 'State',
    ];

    public function mount($coop_id = NULL)
    {
        $this->User = User::find(auth()->user()->id);

        if ($coop_id != NULL){
            $this->coop     = Coop::find($coop_id);
            $this->address  = $this->coop->address()->firstOrCreate();
            $this->page     = "Edit";
            $this->ids      = $this->coop->getids();
            $this->ids      = array_filter($this->ids);
            $this->users    = CoopAdmin::where('coop_id', $this->coop->id)->get();
        } else {
            $this->coop    = new Coop;
            $this->address = new Address;

            $this->coop->created_by = $this->User->name;
            $this->address->created_by = $this->User->name;
        }
        $this->states = RefState::where('coop_id', '1')->get();
    }

    public function add()
    {
        $this->ids   = [...$this->ids, $this->selected ];
        $this->users = User::whereIn('id', $this->ids)->get();
        $this->idrem = array_diff($this->idrem, [$this->selected]);
    }

    public function rem($id)
    {
        $this->idrem = [...$this->idrem, $id ];
        $this->ids   = array_diff($this->ids, [$id]);
        $this->ids   = array_filter($this->ids);
        $this->users = User::whereIn('id', $this->ids)->get();
    }

    public function submit()
    {
        //dd($this->coop);
        $this->validate();

        if($this->ids == []){
            if ($this->coop->status == 1){
                $this->addError('coop.status', 'Can\'t set active without any Admins active');
                $this->addError('search', 'Can\'t set active without any Admins active');
                $this->dispatchBrowserEvent('swal',[
                    'title' => 'Warning!',
                    'text'  => 'Can\'t set ACTIVE without any Admins active',
                    'icon'  => 'warning',
                    'showConfirmButton' => false,
                    'timer' => 10000,
                ]);
                return back();
            }
        }

        $this->coop->save();

        if($this->logo){
            Storage::disk('local')->putFileAs('public/Files/Logo/', $this->logo, $this->coop->id.'-logo.'.$this->logo->extension());
            $filepath   = 'Files/Logo/'.$this->coop->id.'-logo.'.$this->logo->extension();
            $this->coop->logo_path = $filepath;
            $this->coop->files()->updateOrCreate(
                [
                    'filename'     => 'logo'
                ],[
                    'filedesc'     => 'COOP LOGO',
                    'filetype'     => $this->logo->extension(),
                    'filepath'     => $filepath,
                ]
            );
        } else {
            if ($this->coop->logo_path == NULL){
                $this->coop->logo_path = 'img/logo.png';
            }
        }

        foreach ($this->ids as $key => $value) {
            $admin = CoopAdmin::where('coop_id', $this->coop->id)->updateOrCreate([
                'user_id'   => $value,
                'coop_id'   => $this->coop->id,
                'status'    => '1',
                'updated_by'=> $this->User->name,
            ]);
        }
 
        $this->coop->address()->save($this->address);
        $this->coop->address_id = $this->address->id;
        $this->coop->save();

        return redirect()->route('coop.list');
    }

    public function searchUser()
    {
        if (strlen($this->search) > 2){
            $this->userList = User::where('name', 'like', '%'.$this->search.'%')->select('id','name')->orderBy('name')->take(5)->get();
        } else {
            $this->userList = [];
        }
    }

    public function updatedPhoto()
    {
        $this->validate([
            'logo' => 'image|max:5120', // 5MB Max
        ]);
    }

    public function deb()
    {
        dd([
            'ids'   => $this->ids,
            'idrem' => $this->idrem,
            'users' => $this->users,
        ]);
    }

    public function render()
    {
        return view('livewire.page.admin.Coop.Create')->extends('layouts.head');
    }
}
