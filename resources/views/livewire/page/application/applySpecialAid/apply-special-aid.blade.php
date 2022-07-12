<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Special Aid</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-general.header-title title="Information" route=""/>    
        <div class="p-4">
            @if (session('success'))
                <x-swall.success message="{{ session('message') }}"/>
            @endif
            <div x-data="{isShowing: '' }">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-3">
                    <div>
                        <x-form.dropdown 
                            label="Special Aid"
                            value=""
                            name="type_specialAid" 
                            id="type_specialAid"
                            mandatory=""
                            disable=""
                            default="yes"  
                            x-model="isShowing"
                            >
                            @foreach ($specialAids as $type)
                                <option x-bind:value="'{{ $type->name }}'" value="{{ $type->name }}">{{ ucwords($type->name) }}</option>                                        
                            @endforeach
                        </x-form.dropdown>                            
                    </div>
                </div>
                
                @foreach ($specialAids as $index => $listField)
                    <div x-cloak x-show="isShowing === '{{ $listField->name }}'">
                        <x-form.basic-form wire:submit.prevent="submit('{{ $listField->uuid }}','{{ $index }}')">
                            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">
                                <div>
                                    <x-form.input 
                                        label="Name" 
                                        name="customer_name" 
                                        value="" 
                                        mandatory=""
                                        disable=""
                                        type="text"                                    
                                        wire:model.lazy='customer_name'    
                                    />
                                    @if (session('nameError'))
                                        <p class="mt-2 text-sm text-red-600">{{ session('nameError') }}</p>
                                    @endif
                                </div>

                                @php if ($listField->apply_amt_enable == 0) {$isDisabled = 'true';} else{$isDisabled = 'false';} @endphp
                                <div>                            
                                    <x-form.input-tag                 
                                        label="Apply Amount" 
                                        type="text"
                                        name="apply_amt.{{ $index }}" 
                                        value=""
                                        leftTag="RM"
                                        rightTag=""
                                        mandatory=""
                                        disable="{{ $isDisabled }}"                                   
                                        wire:model.lazy='apply_amt.{{ $index }}'
                                    />                                             

                                    @if (session('errors'))
                                        <p class="mt-2 text-sm text-red-600">{{ session('errors') }}</p>
                                    @endif
                                </div>

                                @foreach ($listField->field as $key => $list)                                   
                                    <div @if ($list->status == 0) style="display: none" @endif>
                                        <div>
                                            <x-form.input 
                                                label="{{ ucwords($list->label) }}" 
                                                name="{{ $list->name }}" 
                                                value="" 
                                                mandatory=""
                                                disable=""
                                                type="{{ $list->type }}"                                    
                                                wire:model.lazy='FspecialAid.{{ $key }}'    
                                            />
                                            @error('FspecialAid.'.$key)
                                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                            @enderror                                            

                                            @if ($list->required == '1')
                                                @if (session('warning'))
                                                    <p class="mt-2 text-sm text-red-600">{{ session('warning') }}</p>
                                                @endif                                                
                                            @endif
                                        </div>
                                    </div>                                        
                                @endforeach
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
                @endforeach                
            </div>
        </div>
    </div>
</div>