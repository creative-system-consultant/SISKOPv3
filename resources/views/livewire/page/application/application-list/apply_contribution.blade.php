@extends('layouts.head')
@section('content')
<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Add Contribution</h1>
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

            <h2 class="mb-4 mt-6 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>  
            <div class="grid grid-cols-12 gap-6" x-data="{showing: '{{ $custApply->start_apply != NULL ? 'Starting Date' : 'One Month' }}', isSelect: false}">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input 
                        label="Date Options"
                        value="{{ $custApply->start_apply != NULL ? 'Starting Date' : 'One Month' }}"
                        name="cont_type" 
                        id="cont_type"
                        mandatory=""
                        disable="true"
                        default="yes"
                    />                               
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <div x-cloak x-show="showing == 'Starting Date' ? isSelect = true : isSelect = false">
                        <x-form.input 
                            label="Start Date" 
                            name="start_contDate" 
                            value="{{ $custApply->start_apply == NULL ? '' : $custApply->start_apply->format('Y-m-d') }}" 
                            mandatory=""
                            disable="true"
                            type="date"
                            wire:model.defer="start_contDate"                    
                        />  
                    </div>
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <div x-cloak x-show="showing == 'Starting Date' ? isSelect = true : isSelect = false">
                        <x-form.input 
                            label="Approved Start Date" 
                            name="start_approvedDate" 
                            value="{{ $custApply->start_approved == NULL ? '' : $custApply->start_approved->format('Y-m-d') }}" 
                            mandatory=""
                            disable="true"
                            type="date"
                            wire:model.defer="start_approvedDate"                    
                        />  
                    </div>
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