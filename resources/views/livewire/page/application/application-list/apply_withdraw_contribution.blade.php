@extends('layouts.head')
@section('content')
<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Withdrawal Contribution</h1>
    <div class="pt-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pl-4 pb-4 pr-4">
            <h2 class="mb-4 mt-6 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>  
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input 
                    label="Name" 
                    name="custname" 
                    value="{{ $custApply->customer->name }}" 
                    mandatory=""
                    disable="true"
                    type="text"
                />  

                <x-form.input 
                    label="Identity Number" 
                    name="custic" 
                    value="{{ $custApply->customer->icno }}"                     
                    mandatory=""
                    disable="true"
                    type="text"
                />               
                
                <x-form.input-tag 
                    label="Current Contribution Amount" 
                    type="text"
                    name="current_cont" 
                    value="{{  $custApply->amt_before  }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />       
                
                <x-form.input-tag 
                    label="Monthly Contribution" 
                    type="text"
                    name="monthly_cont" 
                    value="{{  $custApply->customer->contribution_monthly  }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />  
            </div>

            <h2 class="mb-4 mt-6 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>  
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <div>
                    <x-form.input-tag 
                        label="Add Contribution applied" 
                        type="text"
                        name="cont_apply" 
                        value="{{ $custApply->apply_amt }}"
                        placeholder="0.00"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>        
                
                <div>
                    <x-form.input-tag 
                        label="Add Contribution approved" 
                        type="text"
                        name="cont_approved" 
                        value="{{ $custApply->approved_amt }}"
                        placeholder="0.00"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                </div>   
                
                <div>
                    <x-form.dropdown 
                        label="Bank"
                        value=""
                        name="bank_code" 
                        id="bank_code"
                        mandatory=""
                        disable="true"
                        default="yes"  
                        >
                        @foreach ($banks as $bank)
                            <option @if ($bank->code == $custApply->bank_code) selected @endif>{{ $bank->description }}</option>                            
                        @endforeach
                    </x-form.dropdown>                            
                </div>

                <div>
                    <x-form.input 
                        label="Account Bank No." 
                        name="bank_account" 
                        id="bank_account"
                        value="{{ $custApply->bank_account }}" 
                        mandatory=""
                        disable="true"
                        type="text"
                    />                                     
                </div>
            </div>

            <h2 class="mb-4 mt-6 text-lg font-semibold border-b-2 border-gray-300">Upload Document</h2>  
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <div>
                    @forelse ($custApply->files as $supportDoc)
                        <a href="{{ asset('storage/'.$supportDoc->filepath) }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                            <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                            Show
                        </a>
                    @empty
                        <h2 class="ml-4 mb-4 text-base border-gray-300">No Document</h2> 
                    @endforelse
                </div>
            </div>
            <div class="p-4 mt-6 rounded-md bg-gray-50">
                <div class="flex items-center justify-center space-x-2">
                    <a href="{{route('application.list')}}" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                        Close
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>   
@endsection