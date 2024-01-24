@props([
    'label' => '',
    'value' => '',
    'disable' => 'false',
    'name' => '',
    'id' => '',
    'range1' => '',
    'range2' => '',
    'range1_enable' => 'true',
    'range2_enable' => 'true',
    'range_rem' => 'false',
    'range_remFn' => '',
    'range_add' => 'false',
    'range_addFn' => '',
])
<div>
    <div class="flex items-center mt-1 mb-2 ">
    <input 
        @if( $disable == "true" )
            disabled
        @elseif( $disable == "readonly" )
            readonly
        @endif
        {{ $attributes }}
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        type="radio" 
        class="transition duration-150 ease-in-out form-radio text-primary-800">
        <label for="{{ $id }}" class="ml-2 block text-sm font-semibold leading-5 text-gray-700 {{ ($errors->has($name)) ? 'text-red-700' : '' }}">
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-4 gap-6">
                @if($label != '')
                <div class="relative flex mt-1 mb-2">
                    <span class="my-2">{{ $label }}</span>
                </div>
                @endif
                <div class="relative flex mt-1 mb-2 rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-500 sm:text-sm dark:text-gray-50">
                            RM
                        </span>
                    </div>
                    <input type="text" 
                        class="form-input text-sm block w-full transition duration-150 ease-in-out sm:leading-5 pl-9
                            {{ ($range1_enable == 'false' || $range1_enable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                        value=""
                        @if( $range1_enable == "false" )
                            disabled
                        @elseif( $range1_enable == "readonly" )
                            readonly
                        @endif 
                        wire:model.debounce.1200ms="{{ $range1 }}" >
                </div>
                <div class="relative flex mt-1 mb-2 rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <span class="text-gray-500 sm:text-sm dark:text-gray-50">
                            RM
                        </span>
                    </div>
                    <input type="text" 
                        class="form-input text-sm block w-full transition duration-150 ease-in-out sm:leading-5 pl-9
                            {{ ($range2_enable == 'false' || $range2_enable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}"
                        value=""
                        @if( $range2_enable == "false" )
                            disabled
                        @elseif( $range2_enable == "readonly" )
                            readonly
                        @endif 
                        wire:model.debounce.1200ms="{{ $range2 }}" >
                </div>
                <div class="relative flex mt-1 mb-2">
                @if($range_add == 'true')
                    <button type="button" wire:click="{{ $range_addFn }}" class="flex items-center justify-center p-2 mx-2 text-sm font-semibold text-white bg-green-500 rounded-md shadow-sm focus:outline-none">
                        <x-heroicon-s-plus-circle class="w-5 h-5"/>
                    </button>
                @endif
                @if($range_rem == 'true')
                    <button type="button" wire:click="{{ $range_remFn }}" class="flex items-center justify-center p-2 mx-2 text-sm font-semibold text-white bg-red-500 rounded-md shadow-sm focus:outline-none">
                        <x-heroicon-s-minus-circle class="w-5 h-5"/>
                    </button>
                @endif
                </div>
            </div>
        </label>
    </div>
    @if($errors->has($name)) <p class="text-sm text-red-600">{{ $errors->first($name) }}</p> @endif
</div>