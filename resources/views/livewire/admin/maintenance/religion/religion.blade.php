<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Religion Maintenance</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        @if (session('success'))
            <x-swall.success message="{{ session('message') }}"/>
        @endif

        <a href="{{ route('religion.create') }}" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400">
            <x-heroicon-o-plus-circle class="w-4 h-4 mr-2" />
            Create
        </a>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left " value="NO." sort="" />
                <x-table.table-header class="text-left" value="RELIGION NAME" sort="" />
                <x-table.table-header class="text-left" value="CODE" sort="" />
                <x-table.table-header class="text-left" value="STATUS" sort="" />
                <x-table.table-header class="text-left" value="ACTION" sort="" />
            </x-slot>
            <x-slot name="tbody">
                @forelse ($RefReligion as $religion)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $loop->iteration }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $religion->description }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $religion->code }}                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $religion->status }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left" x-data="{deleteModal:false}">
                            <a href="{{ route('religion.edit',$religion->id) }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                                <x-heroicon-o-pencil-square class="w-4 h-4 mr-2"/>
                                Edit
                            </a>
                            <button @click="deleteModal = true"
                                class = "inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-red-500 rounded hover:bg-red-400">
                                <x-heroicon-o-trash class="w-4 h-4 mr-2"/>
                                Delete
                            </button>
                            <x-modal.delete-modal modalActive="deleteModal" deleteFunction="delete({{ $religion->id }})" />
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
