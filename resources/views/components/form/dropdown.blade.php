<div>
    @if($label != "")
        <label class="block text-sm font-semibold leading-5 text-gray-700">
            {{ $label }}
            @if($mandatory ?? '' == "yes")
                <span class="font-semibold text-red-600">*</span>
            @endif
        </label>
    @endif

    <div class="mt-1 rounded-md shadow-sm">
        <select name="{{ $value }}" class="block w-full transition duration-150 ease-in-out form-select sm:text-sm sm:leading-5 
            {{ ($disable == 'true') ? 'bg-gray-100 cursor-not-allowed' : '' }}   
            {{ ($errors->has($value)) ? 'border-red-300 bg-red-50 text-red-900' : ''}}"
            {{ $attributes }}  {{ $disable == "true" ? 'disabled' : '' }} >
            @if($default == 'yes')
                <option value="" selected>Please Choose </option>
            @endif
            {{ $slot }}
        </select>
    </div>
    @if($value !="" && $errors->has($value)) <p class="text-sm text-red-600">{{ $errors->first($value) }}</p> @endif
</div>