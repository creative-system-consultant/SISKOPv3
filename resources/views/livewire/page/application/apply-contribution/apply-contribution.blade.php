<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Add Contribution</h1>
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
            <x-form.basic-form wire:submit.prevent="alertConfirm" x-data="{select: '', showing: '', isSelect: false}">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
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

                        @error('cont_apply')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                        <x-form.dropdown 
                            label="Types of Add Contribution"
                            value=""
                            name="cont_type" 
                            id="cont_type"
                            mandatory=""
                            disable=""
                            default="yes"
                            x-model="select"
                            wire:model="cont_type"
                            >
                            <option value="pay_once">Pay Once </option>
                            <option value="cont_date">Change Monthly Contribution From Date</option>
                        </x-form.dropdown>         
                        
                        @error('cont_type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                        <div x-cloak x-show ="select == 'cont_date'">
                            <x-form.input 
                                label="Start Date" 
                                name="start_contDate" 
                                value="" 
                                mandatory=""
                                disable=""
                                type="date"
                                wire:model.defer="start_contDate"
                                
                            />  
    
                            @error('start_contDate')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div x-cloak x-show ="select == 'pay_once'">
                    <div class="grid grid-cols-12 gap-6">                    
                        <div class="col-span-12 mb-6 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                            <x-form.dropdown 
                                label="Payment Method"
                                value=""
                                name="payment_method" 
                                id="payment_method"
                                mandatory=""
                                disable=""
                                default="yes"
                                x-model="showing"
                                wire:model="payment_method"
                                >
                                <option value="online">Online Banking</option>
                                <option value="cash">Cash Payment</option>
                                <option value="cheque">By Cheque</option>
                            </x-form.dropdown>         
                            
                            @error('payment_method')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    
                    <div x-cloak x-show="showing == 'online' ? isSelect = true : isSelect = false">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                            <div>
                                <x-form.input 
                                    label="Online Payment Date" 
                                    name="online_date" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="date"
                                    wire:model.defer="online_date"
                                    
                                />  
    
                                @error('online_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <div>
                                <x-form.input 
                                    label="Upload Online Payment Receipt:(uploaded only: jpg/png/jpeg/pdf)" 
                                    name="online_file" 
                                    id="online_file"
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="file"
                                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                                    wire:model.defer="online_file"
                                />  
    
                                @error('online_file')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>   
                    
                    <div x-cloak x-show="showing == 'cash' ? isSelect = true : isSelect = false">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    
                            <div>
                                <x-form.input 
                                    label="CDM Payment Date" 
                                    name="cdm_date" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="date"
                                    wire:model.defer="cdm_date"
                                />  
    
                                @error('cdm_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <div>
                                <x-form.input 
                                    label="Upload CDM Payment Receipt:(uploaded only: jpg/png/jpeg/pdf)" 
                                    name="cdm_file" 
                                    id="cdm_file"
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="file"
                                    accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                                    wire:model.defer="cdm_file"
                                />  
    
                                @error('cdm_file')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
    
                        </div>
                    </div> 
    
                    <div x-cloak x-show="showing == 'cheque' ? isSelect = true : isSelect = false">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
    
                            <div>
                                <x-form.input 
                                    label="Cheque No." 
                                    name="" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="text"
                                    wire:model="cheque_no"
                                />                        
    
                                @error('cheque_no')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <div>
                                <x-form.input 
                                    label="Cheque Date" 
                                    name="cheque_date" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="date"
                                    wire:model.defer="cheque_date"
                                />   
    
                                @error('cheque_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <div>
                                <x-form.dropdown 
                                    label="Bank"
                                    value=""
                                    name="banks" 
                                    id="banks"
                                    mandatory=""
                                    disable=""
                                    default="yes"  
                                    >
                                    @foreach ($banks as $bank)
                                        <option value="{{ $bank->code }}">{{ $bank->description }}</option>                            
                                    @endforeach
                                </x-form.dropdown>                            
                            </div>
                        </div>
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