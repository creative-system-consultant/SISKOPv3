<div {{ $attributes }}>
    <div class="flex items-center justify-between w-full">
        <label class="block text-sm font-semibold leading-5 text-gray-700">
            {{ $label }}
            @if( $mandatory ?? '' == "true")
                <span class="font-semibold text-red-600">*</span>
            @endif
        </label>
        @if($mailFlag ?? '' == "true")
        <div>
            <x-form.checkbox
                label="Mailing Flag"
                id=""
                name=""
                value=""
                disable="{{ $disable }}"
                wire:model="{{ $name7 }}"
            />
        </div>
        @endif
    </div>
    <div class="flex mt-1 mb-2 rounded-md shadow-sm">
        <input
            @if( $disable == "true" )
                disabled
            @elseif( $disable == "readonly" )
                readonly
            @endif
            wire:model="{{ $name1 }}" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5
            {{ ($errors->has($name1)) ? 'border-red-300 bg-red-50 text-red-900' : '' }}
            {{ ($disable == 'true' || $disable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}  "
            placeholder="Address Line 1"
            oninput="this.value = this.value.toUpperCase()"
        >
    </div>
    @if($errors->has($name1)) <p class="text-sm text-red-600">{{ $errors->first($name1) }}</p> @endif

    <div class="flex mt-1 mb-2 rounded-md shadow-sm">
        <input
            @if( $disable == "true" )
                disabled
            @elseif( $disable == "readonly" )
                readonly
            @endif
            wire:model="{{ $name2 }}" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5
            {{ ($errors->has($name2)) ? 'border-red-300 bg-red-50 text-red-900' : '' }}
            {{ ($disable == 'true' || $disable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}  "
            placeholder="Address Line 2"
            oninput="this.value = this.value.toUpperCase()"
        >
    </div>
    @if($errors->has($name2)) <p class="text-sm text-red-600">{{ $errors->first($name2) }}</p> @endif

    <div class="flex mt-1 mb-0 rounded-md shadow-sm">
        <input
            @if( $disable == "true" )
                disabled
            @elseif( $disable == "readonly" )
                readonly
            @endif
            wire:model="{{ $name3 }}" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5
            {{ ($errors->has($name3)) ? 'border-red-300 bg-red-50 text-red-900' : '' }}
            {{ ($disable == 'true' || $disable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}  "
            placeholder="Address Line 3 (optional)"
            oninput="this.value = this.value.toUpperCase()"
        >
    </div>
    @if($errors->has($name3)) <p class="text-sm text-red-600">{{ $errors->first($name3) }}</p> @endif
</div>
<div class="grid grid-cols-1 gap-2 mt-3 md:grid-cols-3 lg:grid-cols-3 sm:grid-cols-1 xl:grid-cols-3">
    <div>
        <label class="block text-sm font-semibold leading-5 text-gray-700">
            Postcode
            @if( $mandatory ?? '' == "true")
                <span class="font-semibold text-red-600">*</span>
            @endif
        </label>
        <div class="flex mt-1 mb-2 rounded-md shadow-sm">
            <input
                @if( $disable == "true" )
                    disabled
                @elseif( $disable == "readonly" )
                    readonly
                @endif
                wire:model="{{ $name5 }}" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5
                {{ ($errors->has($name5)) ? 'border-red-300 bg-red-50 text-red-900' : '' }}
                {{ ($disable == 'true' || $disable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}    "
                placeholder=""
            >
        </div>
        @if($errors->has($name5)) <p class="text-sm text-red-600">{{ $errors->first($name5) }}</p> @endif
    </div>
    <div>
        <label class="block text-sm font-semibold leading-5 text-gray-700">
            Town
            @if( $mandatory ?? '' == "true")
                <span class="font-semibold text-red-600">*</span>
            @endif
        </label>
        <div class="flex mt-1 mb-2 rounded-md shadow-sm">
            <input
                @if( $disable == "true" )
                    disabled
                @elseif( $disable == "readonly" )
                    readonly
                @endif
                wire:model="{{ $name4 }}" type="text" class="form-input block w-full transition duration-150 ease-in-out sm:text-sm sm:leading-5
                {{ ($errors->has($name4)) ? 'border-red-300 bg-red-50 text-red-900' : '' }}
                {{ ($disable == 'true' || $disable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}    "
                placeholder="Town"
                oninput="this.value = this.value.toUpperCase()"
            >
        </div>
        @if($errors->has($name4)) <p class="text-sm text-red-600">{{ $errors->first($name4) }}</p> @endif
    </div>
    
    <div>
        <label class="block text-sm font-semibold leading-5 text-gray-700">
            State
            @if( $mandatory ?? '' == "true")
                <span class="font-semibold text-red-600">*</span>
            @endif
        </label>
        <div class="mt-1 rounded-md shadow-sm">
            <select
                @if( $disable == "true" )
                    disabled
                @elseif( $disable == "readonly" )
                    readonly
                @endif
                wire:model="{{ $name6 }}"
                class="block w-full transition duration-150 ease-in-out form-select sm:text-sm sm:leading-5
                {{ ($errors->has($name6)) ? 'border-red-300 bg-red-50 text-red-900' : '' }}
                {{ ($disable == 'true' || $disable == 'readonly') ? 'bg-gray-100 cursor-not-allowed' : '' }}   "
                >
                <option value="" hide selected>SELECT STATE</option>
                @isset($state)
                @foreach ($state as $item)
                    <option value="{{ $item->id }}" >{{ $item->description }}</option>
                @endforeach
                @endisset
            </select>
        </div>
        @if($name6 !="" && $errors->has($name6)) <p class="text-sm text-red-600">{{ $errors->first($name6) }}</p> @endif
    </div>
</div>