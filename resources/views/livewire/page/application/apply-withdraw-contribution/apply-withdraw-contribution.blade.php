<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Withdrawal Contribution</h1>
    <div class="pt-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pl-4 pb-4 pr-4">
            <h2 class="mb-4 mt-6 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>  
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input 
                    label="Name" 
                    name="custname" 
                    value="" 
                    mandatory=""
                    disable="true"
                    type="text"
                    wire:model.defer="cust.name"
                />  
                <x-form.input 
                    label="Identity Number" 
                    name="custic" 
                    value=""                     
                    mandatory=""
                    disable="true"
                    type="text"
                    wire:model.defer="cust.icno"
                />               
                
                <x-form.input-tag 
                    label="Current Contribution Amount" 
                    type="text"
                    name="current_cont" 
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    wire:model.defer="cust.contribution"
                />       
                
                <x-form.input-tag 
                    label="Monthly Contribution" 
                    type="text"
                    name="monthly_cont" 
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                    wire:model.defer="cust.contribution_monthly"
                />  
            </div>

            <h2 class="mb-4 mt-6 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>  
            <x-form.basic-form wire:submit.prevent="alertConfirm">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <div>
                        <x-form.input-tag 
                            label="Add Contribution applied" 
                            type="text"
                            name="cont_apply" 
                            value=""
                            placeholder="0.00"
                            leftTag="RM"
                            rightTag=""
                            mandatory=""
                            disable=""
                            wire:model.defer="cont_apply"
                        />
                    </div>           
                    
                    <div>
                        <x-form.dropdown 
                            label="Bank"
                            value=""
                            name="bank_code" 
                            id="bank_code"
                            mandatory=""
                            disable=""
                            default="yes"  
                            wire:model.defer="bank_code"
                            >
                            @foreach ($banks as $bank)
                                <option value="{{ $bank->code }}">{{ $bank->description }}</option>                            
                            @endforeach
                        </x-form.dropdown>                            
                    </div>

                    <div>
                        <x-form.input 
                            label="Account Bank No." 
                            name="bank_account" 
                            id="bank_account"
                            value="" 
                            mandatory=""
                            disable=""
                            type="text"
                            wire:model.defer="bank_account"
                        />                                     
                    </div>
                </div>

                <h2 class="mb-4 mt-6 text-lg font-semibold border-b-2 border-gray-300">Upload Document (uploaded only: jpg/png/jpeg/pdf)</h2>  
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <div>
                        <x-form.input 
                            label="Upload Supporting Document" 
                            name="support_file" 
                            id="support_file"
                            value="" 
                            mandatory=""
                            disable=""
                            type="file"
                            accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                            wire:model.defer="support_file"
                        /> 
                    </div>
                </div>

                <div class="p-4 mt-6 rounded-md bg-gray-50">
                    <div class="flex items-center justify-center space-x-2">
                        <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                            Submit
                        </button>
                    </div>
                </div>
            </x-form.basic-form>
        </div>
    </div>
</div>

@push('js')
<script>
    window.addEventListener('swal:confirm', event => { 
        swal.fire({
            icon: event.detail.type,
            title: event.detail.text,
            showCancelButton: true,
            cancelButtonText: 'Cancel'
        }).then(function(result){
            if(result.isConfirmed){
                window.Livewire.emit('submit');
            }
        });
    });    
</script>
@endpush