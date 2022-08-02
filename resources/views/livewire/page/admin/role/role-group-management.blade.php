<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">ADMIN > USER > ROLE GROUP</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <a href="{{ route('user.creategroup') }}" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400">
            <x-heroicon-o-plus-circle class="w-4 h-4 mr-2" />
            Create New
        </a>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left" value="NO." sort="" />
                <x-table.table-header class="text-left" value="ROLE GROUP" sort="" />
                <x-table.table-header class="text-left" value="description" sort="" />
                <x-table.table-header class="text-left" value="STATUS" sort="" />
                <x-table.table-header class="text-left" value="ACTION" sort="" />
            </x-slot>
            <x-slot name="tbody">
                @forelse ($rolegroup as $role)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $loop->iteration }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $role->name }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ mb_strimwidth($role->description,0,97,'...') }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $role->status() }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            <a href="{{route('user.editgroup', $role->uuid)}}" type="button" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
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
    </x-general.card>
</div>
