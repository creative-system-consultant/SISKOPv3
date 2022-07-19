<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Country Maintenance > Edit</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-general.header-title title="Country Edit Information" route="{{route('country.list')}}"/>       
        <x-form.basic-form wire:submit.prevent="submit('{{ $RefCountry->id }}')" class="p-4">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <x-form.input 
                    label="Country Name"
                    type="text" 
                    name="description" 
                    value="" 
                    mandatory=""
                    disable=""
                    wire:model.defer="description"  
                />      
                <div>
                    <x-form.input 
                        label="Code"
                        type="text"
                        name="code" 
                        value=""
                        mandatory=""
                        disable=""
                        wire:model.defer="code" 
                    /> 
                </div>

                <div class="flex items-center w-full mt-3">
                    <label for="status" class="block mr-3 text-sm font-semibold leading-5 text-gray-700">
                        Status
                    </label>
                    <label for="status" class="flex items-center cursor-pointer">                                
                        <div class="relative">
                            <input 
                                type="checkbox" 
                                id="status" 
                                class="sr-only"
                                name="status"
                                wire:model="status"
                            >
                            <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                            <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                        </div>
                    </label>
                </div>
                @error('status')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
    </x-general.card>
</div>