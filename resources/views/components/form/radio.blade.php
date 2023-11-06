@props([
    'label' => '',
    'value' => '',
    'disable' => 'false',
    'name' => '',
    'id' => '',
    
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
            {{ $label }}
        </label>
    </div>
    @if($errors->has($name)) <p class="text-sm text-red-600">{{ $errors->first($name) }}</p> @endif
</div>