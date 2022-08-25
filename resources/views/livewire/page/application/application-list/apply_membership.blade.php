<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>  
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
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
                
                <x-form.input 
                    label="Email" 
                    name="custic" 
                    value="{{ $custApply->customer->email ?? '' }}"                     
                    mandatory=""
                    disable="true"
                    type="text"
                />     

                <x-form.input 
                    label="Birthdate" 
                    name="custic" 
                    value="{{ $custApply->customer->birthdate ?? '' }}"                     
                    mandatory=""
                    disable="true"
                    type="text"
                />      
                <x-form.input 
                label="Register Fee" 
                name="custic" 
                value="{{ $custApply->register_fee ?? '' }}"                     
                mandatory=""
                disable="true"
                type="text"
            />                                 
            </div>
            </div>

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