<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Organization > {{ $page }}</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-general.header-title title="Create New Organization" route="{{url()->previous()}}"/>
        <x-form.basic-form wire:submit.prevent="submit" class="p-4">
            <div class="mt-4 mb-8">
                <div class="flex items-center space-x-4">
                    <img 
                        class="w-auto h-32 p-2 rounded-xl ring-2 ring-gray-200 " 
                        @if($logo)
                            src="{{ $logo->temporaryUrl() }}"
                        @elseif($coop->logo_path != '')
                            src="{{ asset('storage/'.$coop->logo_path) }}"
                        @else
                            src="{{ asset('img/logo.png')}}"
                        @endif
                        alt="Organization LOGO"
                    > 
                    <label for="logo">
                        <div wire:loading wire:target="logo">generating preview...</div>
                        <a class="p-2 text-xs font-semibold text-white rounded-md cursor-pointer bg-primary-600">
                            Change LOGO
                        </a>
                    </label>
                    @if($errors->has('logo')) <p class="text-sm text-red-600">{{ $errors->first('logo') }}</p> @endif
                </div>
                <input 
                    type="file" 
                    class="absolute invisible pointer-events-none" 
                    id="logo" 
                    name="logo" 
                    wire:model="logo"
                > 
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-8">
                    <x-form.input 
                        label="Organization Name" 
                        type="text" 
                        name="coop.name" 
                        value="" 
                        mandatory="" 
                        disable="" 
                        wire:model="coop.name"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-4">
                    <x-form.dropdown 
                        label="ACTIVE STATUS"
                        value=""
                        name="coop.status" 
                        mandatory=""
                        disable=""
                        default="" 
                        wire:model="coop.status"
                    >
                        <option value="0">INACTIVE</option>
                        <option value="1">ACTIVE</option>
                    </x-form.dropdown>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <x-form.input 
                        label="Organization Abbreviation" 
                        type="text" 
                        name="coop.name2" 
                        value="" 
                        mandatory="" 
                        disable="" 
                        wire:model="coop.name2"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <x-form.input 
                        label="Organization Registration Num" 
                        type="text" 
                        name="coop.reg_num" 
                        value="" 
                        mandatory="" 
                        disable="" 
                        wire:model="coop.reg_num"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <x-form.dropdown 
                        label="Organization Type"
                        value=""
                        name="coop.type_id" 
                        mandatory=""
                        disable=""
                        default="yes" 
                        wire:model="coop.type_id"
                    >
                    @foreach ($coop->types() as $list)
                        <option value="{{ $list->id }}">{{ $list->description }}</option>
                    @endforeach
                    </x-form.dropdown>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                <x-form.text-area 
                    label="Organization Information" 
                    value="" 
                    name="coop.description" 
                    rows=""
                    disable="" 
                    mandatory="" 
                    placeholder="" 
                    wire:model="coop.description"
                />
            </div>
            <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                <x-form.address class="mt-6"
                    label="Address"
                    mandatory=""
                    disable=""
                    name1="address.address1"
                    name2="address.address2"
                    name3="address.address3"
                    name4="address.town"
                    name5="address.postcode"
                    name6="address.def_state_id"
                    :state="$states"
                    condition="state"
                />
            </div>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                        Cancel
                    </a>
                    <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        {{ $page }}
                    </button>
                </div>
            </div>
        </x-form.basic-form>
    </x-general.card>
</div>
