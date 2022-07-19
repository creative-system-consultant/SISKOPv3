<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Country Maintenance</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        @if (session('success'))
            <x-swall.success message="{{ session('message') }}"/>
        @endif

        <a href="{{route('country.create')}}" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400">
            <x-heroicon-o-plus-circle class="w-4 h-4 mr-2" />
            Create
        </a>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left " value="NO." sort="" />
                <x-table.table-header class="text-left" value="COUNTRY NAME" sort="" />
                <x-table.table-header class="text-left" value="CODE" sort="" />
                <x-table.table-header class="text-left" value="STATUS" sort="" />
                <x-table.table-header class="text-left" value="ACTION" sort="" />
            </x-slot>
            <x-slot name="tbody">
                @forelse ($RefCountry as $country)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $loop->iteration }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $country->description }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $country->code }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $country->status }}
                        </x-table.table-body>              
                        <x-table.table-body colspan="" class="text-left">
                            <a href="{{route('country.edit',$country->id)}}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                <x-heroicon-o-pencil-alt class="w-4 h-4 mr-2"/>
                                Edit
                            </a>
                            <button wire:click="delete({{ $country->id }})"
                                class = "inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-400"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                  </svg></button> 

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
