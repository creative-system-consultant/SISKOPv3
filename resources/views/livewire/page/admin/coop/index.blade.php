<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">COOP Maintenance</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <a href="{{route('coop.create')}}" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400">
            <x-heroicon-o-plus-circle class="w-4 h-4 mr-2" />
            Add
        </a>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left " value="NO." sort="" />
                <x-table.table-header class="text-left" value="COOP NAME" sort="" />
                <x-table.table-header class="text-left" value="SHORT NAME" sort="" />
                <x-table.table-header class="text-left" value="REGISTER NO" sort="" />
                <x-table.table-header class="text-left" value="STATUS" sort="" />
                <x-table.table-header class="text-left" value="ACTION" sort="" />
            </x-slot>
            <x-slot name="tbody">
                @forelse ($coops as $coop)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $loop->iteration }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $coop->name }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $coop->name2 }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $coop->status }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            <button type="button" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                <x-heroicon-o-pencil-alt class="w-4 h-4 mr-2"/>
                                Edit
                            </button>
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


