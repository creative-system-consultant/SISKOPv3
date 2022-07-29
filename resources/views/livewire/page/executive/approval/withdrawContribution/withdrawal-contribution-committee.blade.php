<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Withdrawal Contribution Application</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>  
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input 
                    label="Name" 
                    name="custname" 
                    value="{{ $committee->customer->name ?? '' }}" 
                    mandatory=""
                    disable="true"
                    type="text"
                />  

                <x-form.input 
                    label="Identity Number" 
                    name="custic" 
                    value="{{ $committee->customer->icno ?? '' }}"                     
                    mandatory=""
                    disable="true"
                    type="text"
                />               
                
                <x-form.input-tag 
                    label="Current Contribution Amount" 
                    type="text"
                    name="current_cont" 
                    value="{{  $committee->amt_before ?? '' }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />       
                
                <x-form.input-tag 
                    label="Monthly Contribution" 
                    type="text"
                    name="monthly_cont" 
                    value="{{  $committee->customer->contribution_monthly ?? ''  }}"
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable="true"
                />  
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Contribution Information</h2>  
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <div>
                    <x-form.input-tag 
                        label="Add Contribution applied" 
                        type="text"
                        name="cont_apply" 
                        value="{{ $committee->apply_amt ?? '0.00' }}"
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
                        value="{{ $committee->approved_amt ?? '' }}"
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
                        @foreach ($bankName ?? [] as $bank)
                            <option @if ($bank->code == $committee->bank_code) selected @endif>{{ $bank->description }}</option>                            
                        @endforeach
                    </x-form.dropdown>                            
                </div>

                <div>
                    <x-form.input 
                        label="Account Bank No." 
                        name="bank_account" 
                        id="bank_account"
                        value="{{ $committee->bank_account ?? '' }}" 
                        mandatory=""
                        disable="true"
                        type="text"
                    />                                     
                </div>
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Upload Document</h2>  
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <div>
                    @if ( $committee->files != NULL)
                        @forelse ($committee->files as $supportDoc)
                            <a href="{{ asset('storage/'.$supportDoc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                                <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                                Show
                            </a>
                        @empty
                            <h2 class="mb-4 ml-4 text-base border-gray-300">No Document</h2> 
                        @endforelse
                    @endif
                </div>
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approval Infromation</h2>  
            <div class="grid grid-cols-12 gap-6 mt-8">
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area 
                        label="Note / Comment By Maker" 
                        value="" 
                        name="precheck_note" 
                        rows=""
                        disable="true"
                        mandatory=""
                        placeholder="" 
                    />                    
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area 
                        label="Note / Comment By Checker" 
                        value="" 
                        name="precheck_note" 
                        rows=""
                        disable="true"
                        mandatory=""
                        placeholder="" 
                    />                    
                </div>
            </div>

            <div class="grid grid-cols-12 gap-6 mt-6">                    
                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input 
                        label="Committee" 
                        name="committee_by" 
                        value="{{ auth()->user()->name }}"
                        mandatory=""
                        disable="true"
                        type="text"                            
                    />   
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.text-area 
                        label="Note / Comment By Committee" 
                        value="committee_note" 
                        name="" 
                        rows=""
                        disable=""
                        mandatory=""
                        placeholder="" 
                    />                                      
                </div>

                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <x-form.input 
                        label="Vote" 
                        name="committee_vote" 
                        value=""
                        mandatory=""
                        disable=""
                        type="text"                            
                    />   
                </div>
            </div>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                        Cancel Application
                    </button>
                    <button type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Previous
                     </button>
                    <button type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Next
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>   