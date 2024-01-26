<?php

namespace App\Http\Livewire\Page\Admin\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Ref\RefProductType;
use App\Models\AccountProduct;
use App\Models\AccountProductDocument;
use App\Models\Client;
use App\Models\Ref\RefFinCalcType;
use App\Models\Ref\RefProductDocuments;
use App\Models\User;
use Storage;

class ProductEdit extends Component
{
    use WithFileUploads;

    public User $User;
    public AccountProduct $Product;
    public Client $Coop;
    public $client_id;
    public $loanType;
    public $producttype;
    public $brochure;
    public $brochure_file;
    public $payment_table;
    public $payment_table_file;
    public $refdocument;
    public $document = [];
    public $documentlist = [];
    public $guarantorlist = [];
    public $page = "Edit";

    protected $rules = [
        'Product.name'           => ['required', 'string'],
        'Product.fin_type'       => ['required', 'integer'],
        'Product.product_type'   => ['required', 'integer'],
        'Product.profit_rate'    => ['required', 'numeric', 'lte:100'],
        'Product.amt_min'        => ['required', 'numeric', 'lte:Product.amt_max', 'gt:0'],
        'Product.amt_max'        => ['required', 'numeric', 'gte:Product.amt_min'],
        'Product.term_min'       => ['required', 'integer', 'lte:Product.term_max'],
        'Product.term_max'       => ['required', 'integer', 'gte:Product.term_min'],
        'Product.apply_limit'    => ['required', 'integer'],
        'Product.apply_lifetime' => ['integer'],
        'Product.process_fee'    => ['required', 'numeric', 'gte:0'],
        'Product.takaful_percentage' => ['required', 'numeric', 'gte:0'],
        'Product.bank_charge'    => ['required', 'numeric', 'gte:0'],
        'guarantorlist.*.value1' => ['nullable'],
        'guarantorlist.*.value2' => ['nullable'],
        'guarantorlist.*.num'    => ['nullable', 'integer', 'gte:0'],
    ];

    protected $messages = [
        'Product.name.required'           => ':attribute is required',
        'Product.product_type.required'   => ':attribute is required',
        'Product.profit_rate.required'    => ':attribute is required',
        'Product.amt_min.required'        => ':attribute is required',
        'Product.amt_min.gt'              => 'Application must be more than RM0',
        'Product.amt_max.required'        => ':attribute is required',
        'Product.term_min.required'       => ':attribute is required',
        'Product.term_max.required'       => ':attribute is required',
    ];

    protected $validationAttributes = [
        'Product.name'           => 'Name',
        'Product.fin_type'       => 'Financing Calculation Type',
        'Product.product_type'   => 'Product Type',
        'Product.profit_rate'    => 'Profit Rate',
        'Product.amt_min'        => 'Minimum Financing',
        'Product.amt_max'        => 'Maximum Financing',
        'Product.term_min'       => 'Minimum term',
        'Product.term_max'       => 'Maximum term',
        'guarantorlist.*.value1' => 'Minimum value',
        'guarantorlist.*.value2' => 'Maximum value',
        'guarantorlist.*.num'    => 'Number of guarantor',
    ];

    public function mount($id = NULL)
    {
        $this->User = auth()->user();
        $this->client_id = $this->User->client_id;
        $this->Coop = Client::find($this->client_id);
        $this->refdocument = RefProductDocuments::where('client_id', NULL)->get();

        if ($id == NULL){
            $this->Product = new AccountProduct;
            $this->Product->client_id = $this->client_id;
            $this->page = "Create";
            $this->guarantorlist[0]['value1'] = 0;
            $this->guarantorlist[0]['value2'] = 0;
            $this->guarantorlist[0]['num'] = 0;
        } else {
            $this->Product = AccountProduct::where('id', $id)->first();
            $guarantors = $this->Product->guarantor;

            if ($guarantors->count() > 0){
                $cnt = 0;
                foreach ($guarantors as $item) {
                    $this->guarantorlist[$cnt]['value1'] = $item->min;
                    $this->guarantorlist[$cnt]['value2'] = $item->max;
                    $this->guarantorlist[$cnt]['num'] = $item->num;
                    $cnt++;
                }
            } else {
                $this->guarantorlist[0]['value1'] = 0;
                $this->guarantorlist[0]['value2'] = 0;
                $this->guarantorlist[0]['num'] = 0;
            }

            foreach ($this->refdocument as $key => $value) {
                $item = $this->Product->documents()->where('type', $value->code)->first();
                $this->documentlist[$value->code]['name'] = $value->description;
                if ($item != NULL){
                    $this->documentlist[$value->code]['status'] = $item->status;
                } else {
                    $this->documentlist[$value->code]['status'] = 0;
                }
            }
        }

        $this->producttype        = RefProductType::all();
        $this->brochure_file      = $this->Product->files()->where('filename', 'brochure')->first();
        $this->payment_table_file = $this->Product->files()->where('filename', 'payment_table')->first();
        $this->loanType           = RefFinCalcType::where('client_id', $this->client_id)->get();
    }

    public function enableDoc($code)
    {
        $this->documentlist[$code]['status'] = !$this->documentlist[$code]['status'] ? '1' : 0;
    }

    function addGuarantor() {
        $new['value1'] = 0;
        $new['value2'] = 0;
        $new['num'] = 0;

        array_push($this->guarantorlist, $new);
    }

    function remGuarantor($index){
        array_splice($this->guarantorlist,$index,1);
    }

    public function submit()
    {
        $this->validate();

        $this->Product->save();

        $this->Product->guarantor()->delete();
        foreach($this->guarantorlist as $key => $value){
            $this->Product->guarantor()->UpdateOrCreate([
                'min' => $value['value1'],
                'max' => $value['value2'],
            ],[
                'client_id' => $this->client_id,
                'product_id' => $this->Product->id,
                'num' => $value['num'],
            ]);
        }

        $this->Product->documents()->delete();
        foreach($this->refdocument as $key => $value){
            if ($this->documentlist[$value->code]['status'] == 1){
                $this->Product->documents()->updateOrCreate([
                    'status' => $this->documentlist[$value->code]['status'],
                    'name' => $value->description,
                ],[
                    'client_id' => $this->client_id,
                    'product_id' => $this->Product->id,
                    'type' => $value->code,
                ]);
            }
        }

        if($this->brochure){
            $filepath = 'Files/'.$this->client_id.'/Financing/product/'.$this->Product->id.'/'.'brochure.'.$this->brochure->extension();

            Storage::disk('local')->putFileAs('public/Files/' .$this->client_id. '/financing/product//'.$this->Product->id, $this->brochure, 'brochure'.'.'.$this->brochure->extension());

            $this->Product->files()->updateOrCreate([
                'filename' => 'brochure',
                'filedesc' => 'Brochure',
                'filetype' => $this->brochure->extension(),
                'filepath' => $filepath,
            ]);
        };

        if($this->payment_table){
            $filepath = 'Files/'.$this->client_id.'/Financing/product/'.$this->Product->id.'/'.'payment_table.'.$this->payment_table->extension();

            Storage::disk('local')->putFileAs('public/Files/' .$this->client_id. '/financing/product//'.$this->Product->id, $this->payment_table, 'payment_table'.'.'.$this->payment_table->extension());

            $this->Product->files()->updateOrCreate([
                'filename' => 'payment_table',
                'filedesc' => 'Payment Table',
                'filetype' => $this->payment_table->extension(),
                'filepath' => $filepath,
            ]);
        };

        session()->flash('message', 'Product Updated');
        session()->flash('time', 10000);
        session()->flash('success');
        session()->flash('title');

        return redirect()->route('product.list');
    }

    public function deb(){
        dd([
            'Coop' => $this->Coop,
            'client_id' => $this->client_id,
            'Product' => $this->Product,
            'guarantor list' => $this->guarantorlist,
            'document' => $this->document,
            'documentlist' => $this->documentlist,
            'refdocument' => $this->refdocument,
        ]);
    }

    public function render()
    {
        return view('livewire.page.admin.product.edit')->extends('layouts.head');
    }
}
