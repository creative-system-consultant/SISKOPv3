<div {{ $attributes }}>
    <label class="block text-sm font-semibold leading-5 text-gray-700">
        {{ $label }}
        @if( $mandatory ?? '' == "true")
            <span class="font-semibold text-red-600">*</span>
        @endif
    </label>
    <div class="mt-1 rounded-md shadow-sm">
        <select
            wire:model="{{ $value }}"
            class="block w-full transition duration-150 ease-in-out form-select sm:text-sm sm:leading-5 {{ ($errors->has($value)) ? 'border-red-300 bg-red-50 text-red-900' : ''}}"
            wire:loading.attr='readonly'
            wire:loading.class="bg-gray-300"
            wire:target="submit">
            {{ $slot }}
        </select>
    </div>
    @if($value !="" && $errors->has($value)) <p class="text-sm text-red-600">{{ $errors->first($value) }}</p> @endif
</div>