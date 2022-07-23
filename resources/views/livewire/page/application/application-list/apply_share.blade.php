<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>   
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <x-form.input 
                    label="Name" 
                    name="custname" 
                    value="{{ $custApply->customer->name ?? '' }}" 
                    mandatory=""
                    disable="true"
                    type="text"
                />  

                <x-form.input 
                    label="Identity Number" 
                    name="custic" 
                    value="{{ $custApply->customer->icno ?? '' }}"                     
                    mandatory=""
                    disable="true"
                    type="text"
                />               
                
                <x-form.input-tag 
                    label="Current Share Capital Amount" 
                    type="text"
                    name="current_share" 
                    value="{{ $custApply->amt_before ?? '' }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"            
                />                 
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Share Information</h2>  
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input-tag 
                        label="Add Share Capital applied" 
                        type="text"
                        name="share_apply" 
                        value="{{ $custApply->apply_amt ?? '0.00' }}"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"                        
                    />
                </div>

                <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input-tag 
                        label="Add Share Capital approved" 
                        type="text"
                        name="share_approved" 
                        value="{{ $custApply->approved_amt ?? '0.00' }}"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"                        
                    />
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input 
                        label="Payment Method"
                        value="{{ isset($custApply->method) == NULL ? '' : ucwords($custApply->method) }}"
                        name="pay_method" 
                        id="pay_method"
                        mandatory=""
                        disable="true"
                        >
                    </x-form.dropdown>         
                </div>
            </div>
            
            @if (isset($custApply->method) && $custApply->method == 'online' ) 
                <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3" >
                    <div>
                        <x-form.input 
                            label="Online Payment Date" 
                            name="online_date" 
                            value="{{ isset($custApply->online_date) == NULL ? '' : $custApply->online_date->format('Y-m-d') }}" 
                            mandatory=""
                            disable="true"
                            type="date"                                            
                        />  
                    </div>

                    <div>
                        <label for="online_file" class="block mb-1 mr-3 text-sm font-semibold leading-5 text-gray-700">
                            Show Upload Online Payment Receipt
                        </label>
                        @if (isset($custApply->files) != NULL)
                            @forelse ($custApply->files as $doc)
                                @if ($doc->filename == 'online_receipt')
                                    <a href="{{ asset('storage/'.$doc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                                        <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                                        Show
                                    </a>                                    
                                @endif
                            @empty
                                <h2 class="mb-4 ml-4 text-base border-gray-300">No Document</h2>                                 
                            @endforelse
                        @endif
                    </div>
                </div>
            @endif
            
            @if (isset($custApply->method) && $custApply->method == 'cash' )
                <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <div>
                        <x-form.input 
                            label="CDM Payment Date" 
                            name="cdm_date" 
                            value="{{ isset($custApply->cdm_date) == NULL ? '' : $custApply->cdm_date->format('Y-m-d') }}" 
                            mandatory=""
                            disable="true"
                            type="date"            
                        />
                    </div>

                    <div>
                        <label for="online_file" class="block mb-1 mr-3 text-sm font-semibold leading-5 text-gray-700">
                            Show Upload CDM Payment Receipt
                        </label>
                        @if (isset($custApply->files) != NULL)                        
                            @forelse ($custApply->files as $doc)
                                @if ($doc->filename == 'cdm_receipt')
                                    <a href="{{ asset('storage/'.$doc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                                        <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                                        Show
                                    </a>
                                @endif
                            @empty
                                <h2 class="mb-4 ml-4 text-base border-gray-300">No File</h2> 
                            @endforelse
                        @endif                
                    </div>
                </div>
            @endif

            @if (isset($custApply->method) && $custApply->method == 'cheque' )
                <div class="grid grid-cols-1 gap-6 mt-3 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <div>
                        <x-form.input 
                            label="Cheque No." 
                            name="cheque_no" 
                            value="{{ $custApply->cheque_no ?? '' }}" 
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                    </div>

                    <div>
                        <x-form.input 
                            label="Cheque Date" 
                            name="cheque_date" 
                            value="{{ isset($custApply->cheque_date) == NULL ? '' : $custApply->cheque_date->format('Y-m-d') }}"
                            mandatory=""
                            disable="true"
                            type="date"                            
                        />   
                    </div>
                </div>
            @endif
            
            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button @click="openModal = false" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>