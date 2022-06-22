<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Special Aid List > Create</h1>
        <div class="p-4 mt-4 bg-white rounded-md shadow-md">
            <x-general.header-title title="Special Aid Information" route="{{route('special_aid.list')}}"/>

            <div class="pt-4 bg-white ">
                <div class="pl-4 pb-4 pr-4">
                    <x-form.basic-form wire:submit.prevent="submit">
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                            <div>
                                <x-form.input 
                                    label="Name" 
                                    name="specialAid_name" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="text"
                                    
                                    wire:model.defer='specialAid_name'    
                                />
                                @error('specialAid_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
    
                            <div class="flex items-center w-full mt-3">
                                <label for="enable_applyAmt" class="block text-sm font-semibold leading-5 text-gray-700 mr-3">
                                    Enabled Apply Amount 
                                </label>
                                <label for="enabled_apply_amt" class="flex items-center cursor-pointer">                                
                                    <div class="relative">
                                        <input 
                                            type="checkbox" 
                                            id="enabled_apply_amt" 
                                            class="sr-only"
                                            name="enabled_apply_amt"
                                            wire:model.defer='enabled_apply_amt'                                            
                                        >
                                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                    </div>
                                </label>
                            </div>
    
                            <div>
                                <x-form.input-tag 
                                    label="Default Apply Amount" 
                                    type="text"
                                    name="default_apply_amount" 
                                    value=""
                                    leftTag="RM"
                                    rightTag=""
                                    mandatory=""
                                    disable=""
                                    wire:model.defer='default_apply_amount'
                                />                        

                                @error('default_apply_amount')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="p-4 mt-6 rounded-md bg-gray-50">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                                    Cancel
                                </a>
                                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                                    Submit
                                </button>
                            </div>
                        </div>
                    </x-form.basic-form>                    
                </div>
            </div>
        </div>
    </h1>
</div>
