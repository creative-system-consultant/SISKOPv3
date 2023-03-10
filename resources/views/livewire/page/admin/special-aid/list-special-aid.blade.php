
<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Special Aid List</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        @if (session('success'))
            <x-swall.success message="{{ session('message') }}"/>
        @endif

        <a href="{{ route('special_aid.create') }}" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400">
            <x-heroicon-o-plus-circle class="w-4 h-4 mr-2" />
            Add
        </a>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left " value="NO" sort="" />
                <x-table.table-header class="text-left" value="NAME" sort="" />
                <x-table.table-header class="text-left" value="COOP ID" sort="" />
                <x-table.table-header class="text-left" value="STATUS" sort="" />
                <x-table.table-header class="text-left" value="START DATE" sort="" />
                <x-table.table-header class="text-left" value="END DATE" sort="" />
                <x-table.table-header class="text-left" value="ACTION" sort="" />
            </x-slot>
            <x-slot name="tbody" >
                @forelse ($specialAids as $index => $specialAid)
                <tr x-data="{isActive: {{ $specialAid->status }}}">
                        <x-table.table-body colspan="" class="text-left" x-cloak x-bind:class="isActive ? '': 'text-gray-500 bg-gray-200'">
                            {{ $loop->iteration }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left " x-cloak x-bind:class="isActive ? '': 'text-gray-500 bg-gray-200'">
                            {{ $specialAid->name }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left" x-cloak x-bind:class="isActive ? '': 'text-gray-500 bg-gray-200'">
                            {{ $specialAid->coop_id }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left" x-cloak x-bind:class="isActive ? '': 'text-gray-500 bg-gray-200'">
                            <div class="flex items-center w-full mt-3">
                                <label for="statusTabung.{{ $index }}" class="flex items-center cursor-pointer">
                                    <div class="relative">
                                        <input
                                            type="checkbox"
                                            id="statusTabung.{{ $index }}"
                                            class="sr-only"
                                            @click="isActive = !isActive"
                                            wire:model="statusTabung.{{ $index }}";
                                            wire:click="statusUpdate('{{ $specialAid->uuid }}', '{{ $index }}')"
                                        >
                                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                    </div>
                                </label>
                            </div>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left" x-cloak x-bind:class="isActive ? '': 'text-gray-500 bg-gray-200'">
                            {{ $specialAid?->start_date ? date_format($specialAid->start_date, "Y-m-d") : '' }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left" x-cloak x-bind:class="isActive ? '': 'text-gray-500 bg-gray-200'">
                            {{ $specialAid?->end_date ? date_format($specialAid->end_date, "Y-m-d") : '' }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left" x-cloak x-bind:class="isActive ? '': 'text-gray-500 bg-gray-200'">
                            <a href="{{ route('special_aid.edit', $specialAid->uuid) }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400" {{-- @if($specialAid->status==0)style="display:none"@endif --}}>
                                <x-heroicon-o-pencil-square class="w-4 h-4 mr-2"/>
                                Edit
                            </a>
                        </x-table.table-body>
                    </tr>
                @empty
                    <tr>
                        <x-table.table-body colspan="4" class="text-center">
                            No Data
                        </x-table.table-body>
                    </tr>
                @endforelse
            </x-slot>
        </x-table.table>
    </x-general.card>
</div>
