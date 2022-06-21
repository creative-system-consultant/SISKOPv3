<div>
    @if($label != "")
        <label class="block text-sm font-semibold leading-5 text-gray-700 {{ ($errors->has($value)) ? 'text-red-700' : ''}}">
            {{ $label }}
            @if( $mandatory ?? '' == "true")
            <span class="font-semibold text-red-600">*</span>
            @endif
        </label>
    @endif

    <div class="flex mt-1 mb-2 rounded-md shadow-sm">
        <input
            {{ $disable == "true" ? 'disabled' : '' }}
            type="{{ $type ?? '' }}" {{ $attributes }} value="{{$value}}"
            class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5 
            {{ ($disable == 'true') ? 'bg-gray-100 cursor-not-allowed' : '' }}  
            {{ ($errors->has($value)) ? 'border-red-300 bg-red-50 text-red-900' : ''}}"
        >
    </div>
    @if($errors->has($value)) <p class="text-sm text-red-600">{{ $errors->first($value) }}</p> @endif
</div>