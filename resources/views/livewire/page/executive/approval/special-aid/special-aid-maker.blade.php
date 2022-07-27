<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Special Aid Application</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2> 
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">
            <x-form.input 
                label="Name" 
                name="applicant_name" 
                value="{{ $maker->name ?? '' }}" 
                mandatory=""
                disable="true"
                type="text"
            />

            <x-form.input 
                label="IC No." 
                name="applicant_icno" 
                value="{{ $maker->customer->icno ?? '' }}" 
                mandatory=""
                disable="true"
                type="text"
            />
            
            <x-form.input 
                label="Special Aid Type" 
                name="specialAid_type" 
                value="{{ $type->name ?? '' }}" 
                mandatory=""
                disable="true"
                type="text"
            />          
            
            <x-form.input-tag
                label="Apply Amount" 
                name="apply_amt" 
                value="{{ $maker->apply_amt ?? '' }}" 
                mandatory=""
                leftTag="RM"
                rightTag=""
                disable="true"
                type="text"
            />               
            
            @foreach ($maker->field ?? [] as $list)
                <x-form.input 
                    label="{{ $list->label }}" 
                    name="{{ $list->name }}"
                    value="{{ $list->value }}" 
                    mandatory=""
                    disable="true"
                    type="{{ $list->type }}"
                />                
            @endforeach

        </div>
        
        <div class="grid grid-cols-12 gap-6 mt-8">
            <div class="col-span-12 sm:col-span-12 md:col-span-3 lg:col-span-7 xl:col-span-3">
                <x-form.input-tag
                    label="Approved Amount" 
                    name="apply_amt" 
                    value="{{ $maker->apply_amt ?? '' }}" 
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    type="text"
                />  
            </div>
        </div>

        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approval Information</h2> 
        <div class="grid grid-cols-12 gap-6 mt-8">        
            <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                <x-form.input 
                    label="Check By" 
                    name="precheck_by" 
                    value="{{ auth()->user()->name }}"
                    mandatory=""
                    disable="true"
                    type="text"                            
                />   
            </div>

            <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                <x-form.text-area 
                    label="Note / Comment" 
                    value="" 
                    name="precheck_note" 
                    rows=""
                    disable=""
                    mandatory=""
                    placeholder="" 
                />                    
            </div>
        </div>

        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                    Cancel Application
                </button>
                {{-- <a href="{{ route('application.list') }}" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 border-2 rounded-md focus:outline-none">
                    Previous
                </a> --}}
                <button type="button" wire:click.prevent="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                   Next
                </button>
            </div>
        </div>
    </x-general.card>
</div>