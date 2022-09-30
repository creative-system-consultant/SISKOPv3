<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Approvals > {{ cameltoString($page) }}</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-form.basic-form wire:submit.prevent="submit" class="p-4">
            <div class="grid grid-cols-12 gap-6 mt-6">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="Order" sort="" />
                            <x-table.table-header class="text-left" value="Custom Name" sort="" />
                            <x-table.table-header class="text-left" value="Group" sort="" />
                            <x-table.table-header class="text-left" value="Action" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                        @forelse ($lists as $key => $list)
                            <tr>
                                <x-table.table-body colspan="" class="text-left">
                                    {{ $loop->iteration }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                    <x-form.input 
                                        label="" 
                                        name="lists.{{ $key }}.name" 
                                        value="" 
                                        mandatory=""
                                        disable=""
                                        type="text"
                                        wire:model.defer="lists.{{ $key }}.name"
                                        wire:change="save"
                                    />
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                    {{ $list->role->name }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                    <div class="flex items-center">
                                        <button type="button" wire:click="rem({{ $list->id }})" class="flex items-center justify-center p-2 mx-1 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                                            <x-heroicon-o-trash class="w-7 h-7 text-white-800" />
                                        </button>
                                        <button type="button" @if($loop->first) @else wire:click="up({{ $list->order }})" @endif class="flex items-center justify-center p-2 mx-1 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                                            @if($loop->first)
                                            <x-heroicon-o-minus-sm class="w-7 h-7 text-white-800" />
                                            @else
                                            <x-heroicon-o-arrow-circle-up class="w-7 h-7 text-white-800" />
                                            @endif
                                        </button>
                                        <button type="button" @if($loop->last) @else wire:click="down({{ $list->order }})" @endif class="flex items-center justify-center p-2 mx-1 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                                            @if($loop->last)
                                            <x-heroicon-o-minus-sm class="w-7 h-7 text-white-800" />
                                            @else
                                            <x-heroicon-o-arrow-circle-down class="w-7 h-7 text-white-800" />
                                            @endif
                                        </button>
                                    </div>
                                </x-table.table-body>
                            </tr>
                        @empty
                            <tr>
                                <x-table.table-body colspan="3" class="text-left">
                                    NO GROUP ADDED
                                </x-table.table-body>
                            </tr>
                        @endforelse
                            <tr>
                                <x-table.table-body colspan="" class="bg-gray-50 text-left">
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="bg-gray-50 text-left">
                                    <x-form.input 
                                        label="" 
                                        name="custom" 
                                        value="" 
                                        mandatory=""
                                        disable=""
                                        type="text"
                                        wire:model.defer="custom"
                                    />
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="bg-gray-50 text-left">
                                    <x-form.dropdown 
                                        label=""
                                        value=""
                                        name="selected" 
                                        id=""
                                        mandatory=""
                                        disable=""
                                        default="yes" 
                                        wire:model.defer="selected" 
                                    >
                                    @forelse ($coopGroup as $list)
                                        <option value="{{ $list->id }}">{{ $list->name }}</option>
                                    @empty
                                        
                                    @endforelse
                                    </x-form.dropdown>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="bg-gray-50 text-left">
                                    <button type="button" wire:click="add" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                                        ADD
                                    </button>
                                </x-table.table-body>
                            </tr>
                        </x-slot>
                    </x-table.table>
                </div>
            </div>
            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <p>All changes are saved automatically</p>
                </div>
                <div class="flex items-center justify-center space-x-2">
                    <a href="{{url()->previous()}}" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 border-2 rounded-md focus:outline-non">
                        Back
                    </a>
                    <button type="button" wire:click="deb" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        debug
                    </button>
                </div>
            </div>
            <div wire:loading>
                <x-main-loading />
            </div>
        </x-form.basic-form>
    </x-general.card>
</div>
