<div>
    @if($label != "")
        <label class="block text-sm font-semibold leading-5 text-gray-700 {{ ($errors->has($value)) ? 'text-red-700' : ''}}">
            {{ $label }}
        </label>
    @endif
    <textarea {{ $attributes }}  data-feature="all" 
    class="appearance-none block w-full h-full px-3 py-2 border border-gray-300 rounded-md placeholder-gray-400 form-textarea
    focus:outline-none focus:shadow-outline-blue focus:border-blue-300 transition duration-150 ease-in-out sm:text-sm sm:leading-5
    {{ ($errors->has($value)) ? 'border-red-300 bg-red-50 text-red-900' : ''}}"></textarea>
    @if($errors->has($value)) <p class="text-sm text-red-600">{{ $errors->first($value) }}</p> @endif
</div>