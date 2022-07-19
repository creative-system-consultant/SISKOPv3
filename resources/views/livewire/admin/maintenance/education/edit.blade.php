<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl"> Edit Education </h1>
        <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
            <x-general.header-title title="Education List" route="{{route('education.list')}}"/>
            <div class="pt-4">
                <div class="pb-4 pl-4 pr-4">
                    <x-form.basic-form wire:submit.prevent="submit('{{ $education->id }}')">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                            <div>
                                <x-form.input 
                                    label="Educational Institution" 
                                    name="edu_description" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="text"
                                    wire:model.defer='edu_description'    
                                />
                            </div>

                            <div>
                                <x-form.input 
                                    label="Code" 
                                    name="edu_code" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="text"
                                    wire:model.defer='edu_code'    
                                />
                            </div>
    
                            <div class="flex items-center w-full mt-3">
                                <label for="edu_status" class="block mr-3 text-sm font-semibold leading-5 text-gray-700">
                                    Status 
                                </label>
                                <label for="edu_status" class="flex items-center cursor-pointer">                                
                                    <div class="relative">
                                        <input 
                                            type="checkbox" 
                                            id="edu_status" 
                                            class="sr-only"
                                            name="edu_status"
                                            wire:model.defer='edu_status'                                            
                                        >
                                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                                    Cancel
                                </a>
                                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                                    Update
                                </button>
                            </div>
                        </div>
                    </x-form.basic-form>                  
                </div>
            </div>
        </x-general.card>
    </h1>
</div>

        
