<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Organization > {{ $page }}</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-general.header-title title="Create New Organization" route="{{ url()->previous() }}"/>
        <h2 class="mt-4 text-base font-semibold border-b-2 border-gray-300">Basic Information</h2>
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
                            src="{{ asset('img/logo.png') }}"
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
                        id="coop_status"
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
            <div class="grid grid-cols-1 gap-6 mt-4">
                <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                    <x-form.text-area
                        label="Organization Information : ({{ strlen($coop->description) }}/255)"
                        value=""
                        name="coop.description"
                        rows=""
                        disable=""
                        mandatory=""
                        placeholder=""
                        wire:model="coop.description"
                    />
                </div>
            </div>
            <div class="grid grid-cols-1 gap-6 mt-4">
                <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                    <x-form.address class="mt-4"
                        label="Address"
                        mandatory=""
                        disable=""
                        name1="address.address1"
                        name2="address.address2"
                        name3="address.address3"
                        name4="address.town"
                        name5="address.postcode"
                        name6="address.state_id"
                        :state="$states"
                        condition="state"
                    />
                </div>
            </div>
            <h2 class="mt-6 text-base font-semibold border-b-2 border-gray-300">Admin</h2>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-6 xl:col-span-6">
                    <x-form.input
                        label="Search"
                        type="text"
                        name="search"
                        value=""
                        mandatory=""
                        disable=""
                        wire:model="search"
                        wire:keyup.debounce.1500ms="searchUser"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">
                    <x-form.dropdown
                        label="Select Admin"
                        value=""
                        name="selected"
                        mandatory=""
                        disable=""
                        default=""
                        wire:model="selected"
                    >
                        @forelse ($userList as $list)
                            <option value="{{ $list->id }}">{{ $list->name }}</option>
                        @empty
                            <option>search</option>
                        @endforelse
                    </x-form.dropdown>
                </div>
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-8 xl:col-span-2">
                    <div class="p-6">
                        @if($selected != '')
                        <button type="button" wire:click="add" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                            ADD
                        </button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-10 xl:col-span-10">
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="Name" sort="" />
                            <x-table.table-header class="text-left" value="Status" sort="" />
                            <x-table.table-header class="text-left" value="Action" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                            @forelse ($users as $item)
                                <tr>
                                    <x-table.table-body colspan="" class="text-left">
                                        {{ $item->user->name }}
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        {{ $item->status() }}
                                    </x-table.table-body>
                                    <x-table.table-body colspan="" class="text-left">
                                        <button type="button" wire:click="rem({{ $item->id }})" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                                            REMOVE
                                        </button>
                                    </x-table.table-body>
                                </tr>
                            @empty
                                <tr>
                                    <x-table.table-body colspan="3" class="text-left">
                                        No Admins
                                    </x-table.table-body>
                                </tr>
                            @endforelse
                        </x-slot>
                    </x-table.table>
                </div>
            </div>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <a href="{{ url()->previous() }}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                        Cancel
                    </a>
                    <button type="button" wire:click="deb" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        DEBUG
                    </button>
                    <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        {{ $page }}
                    </button>
                </div>
            </div>
        </x-form.basic-form>
    </x-general.card>
</div>
