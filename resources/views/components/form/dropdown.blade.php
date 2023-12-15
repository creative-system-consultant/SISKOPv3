<div>
    @if($label != "")
        <label class="block text-sm font-semibold leading-5 text-gray-700 {{ ($errors->has($name)) ? 'text-red-700' : '' }}">
            {{ $label }}
            @if($mandatory ?? '' == "yes")
                <span class="font-semibold text-red-600">*</span>
            @endif
        </label>
    @endif

    <div class="mt-1 rounded-md shadow-sm">
        <select name="{{ $name }}" class="block w-full transition duration-150 ease-in-out form-select sm:text-sm sm:leading-5
            {{ ($disable == 'true' || $disable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}
            {{ ($errors->has($name)) ? 'border-red-300 bg-red-50 text-red-900' : '' }}"
            {{ $attributes }} {{ $disable == "true" ? 'disabled' : '' }} {{ $disable == "readonly" ? 'disabled' : '' }} >
            @if($default == 'yes')
                <option value="">Please Choose </option>
            @endif
            {{ $slot }}
        </select>
    </div>
    @if($errors->has($name)) <p class="text-sm text-red-600">{{ $errors->first($name) }}</p> @endif
</div>