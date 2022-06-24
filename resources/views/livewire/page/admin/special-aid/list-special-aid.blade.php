
<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Special Aid List</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        @if (session('success'))
            <x-swall.success message="{{ session('message') }}"/>
        @endif

        <a href="{{route('special_aid.create')}}" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400">
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
            <x-slot name="tbody">
                @forelse ($specialAids as $specialAid)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $loop->iteration }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $specialAid->name }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $specialAid->coop_id }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            <div class="flex items-center w-full mt-3">
                                <label for="status_tabung" class="flex items-center cursor-pointer">                                
                                    <div class="relative">
                                        <input 
                                            type="checkbox" 
                                            id="status_tabung" 
                                            class="sr-only"
                                            name="status_tabung"
                                            wire:model="status_tabung"
                                            wire:click="updateStatus('{{ $specialAid->uuid }}')"
                                        >
                                        <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                        <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                    </div>
                                </label>
                            </div>
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $specialAid->start_date }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $specialAid->end_date }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            <a href="{{route('special_aid.edit', $specialAid->uuid)}}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                <x-heroicon-o-pencil-alt class="w-4 h-4 mr-2"/>
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
    </div>
</div>
