<div>
    @if($label != "")
        <label class="block text-sm font-semibold leading-5 text-gray-700 {{ ($errors->has($name)) ? 'text-red-700' : '' }}">
            {{ $label }}
            @if( $mandatory ?? '' == "true")
            <span class="font-semibold text-red-600">*</span>
            @endif
        </label>
    @endif
    <textarea {{ $attributes }}
    @if( $disable == "true" )
        disabled
    @elseif( $disable == "readonly" )
        readonly
    @endif
    data-feature="all"
    class="appearance-none block w-full h-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 form-textarea
    focus:outline-none focus:shadow-outline-blue  transition duration-150 ease-in-out sm:text-sm sm:leading-5
    {{ ($disable == 'true' || $disable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}
    {{ ($errors->has($name)) ? 'border-red-300 bg-red-50 text-red-900' : '' }}">{{ $value }}</textarea>

    @if($errors->has($name)) <p class="text-sm text-red-600">{{ $errors->first($name) }}</p> @endif
</div>
