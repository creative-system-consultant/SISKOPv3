<div>
    <x-general.card class="px-4">
        <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2> 
        <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">
            <x-form.input 
                label="Name" 
                name="applicant_name" 
                value="{{ $custApply->name ?? '' }}" 
                mandatory=""
                disable="true"
                type="text"
            />

            <x-form.input 
                label="IC No." 
                name="applicant_icno" 
                value="{{ $custApply->customer->icno ?? '' }}" 
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
            
            <x-form.input 
                label="Apply Amount" 
                name="apply_amt" 
                value="{{ $custApply->apply_amt ?? '' }}" 
                mandatory=""
                disable="true"
                type="text"
            />   
            
            @foreach ($custApply->field ?? [] as $list)
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

        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <button @click="openModal = false" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                    Close
                </button>
            </div>
        </div>
    </x-general.card>
</div>