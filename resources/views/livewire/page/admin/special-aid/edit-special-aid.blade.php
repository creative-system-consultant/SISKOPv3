<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Special Aid List > Edit</h1>
        <div class="p-4 mt-4 bg-white rounded-md shadow-md">
            <x-general.header-title title="Edit Special Aid" route="{{route('special_aid.list')}}"/>
                 
            <div class="pt-4 bg-white ">    
                <div class="pl-4 pb-4 pr-4">
                    <x-form.basic-form wire:submit.prevent="submit('{{ $specialAid->uuid }}')">
                        <h2 class="mb-4 mt-6 text-lg font-semibold border-b-2 border-gray-300">Information</h2>
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                            <div>
                                <x-form.input 
                                    label="Name" 
                                    name="specialAid_name" 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="text"          
                                    wire:model.defer="specialAid_name"              
                                />

                                @error('specialAid_name')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
    
                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">
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
                                            wire:model="enabled_apply_amt"
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
                                    wire:model="default_apply_amount"
                                />                                                        
                                @error('default_apply_amount')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-form.input-tag 
                                    label="Default Minimum Amount" 
                                    type="text"
                                    name="default_min_amount" 
                                    value=""
                                    leftTag="RM"
                                    rightTag=""
                                    mandatory=""
                                    disable=""
                                    wire:model.defer='default_min_amount'
                                />

                                @error('default_min_amount')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-form.input-tag 
                                    label="Default Maximum Amount" 
                                    type="text"
                                    name="default_max_amount" 
                                    value=""
                                    leftTag="RM"
                                    rightTag=""
                                    mandatory=""
                                    disable=""
                                    wire:model.defer='default_max_amount'
                                />

                                @error('default_max_amount')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                            <div>
                                <x-form.input 
                                    label="Start Date" 
                                    name="start_date"                                 
                                    value="" 
                                    mandatory=""
                                    disable=""
                                    type="date"
                                    wire:model.defer='start_date'
                                />     

                                @error('start_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror                            
                            </div>
                            
                            <div>
                                <x-form.input 
                                    label="End Date" 
                                    value="" 
                                    name="end_date" 
                                    mandatory=""
                                    disable=""
                                    type="date"
                                    wire:model.defer='end_date'
                                />                                                          
                                @error('end_date')
                                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror                        
                            </div>
                        </div>

                        <h2 class="mb-4 mt-6 text-lg font-semibold border-b-2 border-gray-300">Fields</h2>
                        <button wire:click.prevent="createField" type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                            Add Field
                        </button>
                        <div id="fields">
                        @foreach($Fname as $index => $list )
                            <div class="mt-6 grid grid-cols-12 gap-6">
                                @php if ($Fstatus[$index] == false ){ $status = 'true';} else { $status = 'false'; } @endphp
                                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-2 xl:col-span-2">
                                    <x-form.input label="Field Label" name="Flabel.{{ $index }}" value="" mandatory="" disable="{{ $status }}" type="text" wire:model.debounce.500ms="Flabel.{{ $index }}"/>
                                    @error('Flabel.'.$index)
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-2 xl:col-span-2">
                                    <x-form.input label="Field Name" name="Fname.{{ $index }}" value="" mandatory="" disable="{{ $status }}" type="text" wire:model.debounce.500ms="Fname.{{ $index }}"/>
                                    @error('Fname.'.$index)
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-2 xl:col-span-2">
                                    <x-form.dropdown label="Field Type" value="" name="Ftype.{{ $index }}" id="" disable="{{ $status }}" mandatory="" default="" wire:model.debounce.500ms="Ftype.{{ $index }}">
                                        @foreach ($field->types() as $type)
                                            <option value="{{ $type }}">{{ $type }}</option>
                                        @endforeach
                                    </x-form.dropdown>
                                </div>
                                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
                                    <label for="field_status" class="block text-sm font-semibold leading-5 text-gray-700 mr-3">
                                        Enable
                                    </label>
                                    <div class="flex items-center w-full mt-2">
                                        <label for="Fstatus.{{ $index }}" class="flex items-center cursor-pointer">
                                            <div class="relative">
                                                <input 
                                                    type="checkbox" 
                                                    id="Fstatus.{{ $index }}" 
                                                    class="sr-only"
                                                    wire:model='Fstatus.{{ $index }}'
                                                    wire:click="fieldStatus('{{ $specialAid->uuid }}', '{{ $index }}')"
                                                >
                                                <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                                <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                            </div>
                                        </label>
                                    </div>
                                </div>  
                                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
                                    <label for="field_status" class="block text-sm font-semibold leading-5 text-gray-700 mr-3">
                                        Required
                                    </label>
                                    <div class="flex items-center w-full mt-2">
                                        <label for="Frequired.{{ $index }}" class="flex items-center cursor-pointer">
                                            <div class="relative">
                                                <input 
                                                    type="checkbox" 
                                                    id="Frequired.{{ $index }}" 
                                                    class="sr-only"
                                                    wire:model='Frequired.{{ $index }}'
                                                    wire:click="fieldRequired('{{ $specialAid->uuid }}', '{{ $index }}')"
                                                >
                                                <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                                <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                            </div>
                                        </label>
                                    </div>
                                </div> 
                                <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
                                    <div class="pt-4 mt-3 rounded-md justify-end">
                                        <button wire:click.prevent="alertDelete('{{ $specialAid->uuid }}', '{{ $index }}')" type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-2 xl:col-span-2">
                                    <x-form.input label="" name="Fuuid.{{ $index }}" value="" mandatory="" disable="" type="hidden" wire:model="Fuuid.{{ $index }}"/>
                                </div>
                            </div>
                        @endforeach
                        </div>

                        <div class="p-4 mt-6 rounded-md bg-gray-50">
                            <div class="flex items-center justify-center space-x-2">
                                <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-none">
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
                window.Livewire.emit('remField', event.detail.uuid, event.detail.index);
            }
        });
    });    
</script>
@endpush