
<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Maintenance List</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <a href="{{ route('add-maintenance') }}" class="inline-flex items-center px-4 py-2 mb-4 text-sm font-bold text-white bg-green-500 rounded hover:bg-green-400">
            <x-heroicon-o-plus-circle class="w-4 h-4 mr-2" />
            Add
        </a>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left " value="NO" sort="" />
                <x-table.table-header class="text-left" value="PANEL TYPE" sort="" />
                <x-table.table-header class="text-left" value="PANEL NAME" sort="" />
                <x-table.table-header class="text-left" value="DESCRIPTION" sort="" />
                <x-table.table-header class="text-left" value="STATUS" sort="" />
                <x-table.table-header class="text-left" value="ACTION" sort="" />
            </x-slot>
            <x-slot name="tbody">
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        1
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        Motor
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        RED ORANGES SOLUTION
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        Peranti Pintar, Motorsikal
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        <div class="flex items-center w-full">
                            <label for="1" class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input
                                        type="checkbox"
                                        id="1"
                                        class="sr-only"
                                        {{-- wire:click="statusBtn(1)" --}}
                                    >
                                    <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                    <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                </div>
                            </label>
                        </div>
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        <a href="{{ route('edit-maintenance',['id' => 1]) }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-orange-500 rounded hover:bg-orange-400">
                            <x-heroicon-o-pencil-square class="w-4 h-4 mr-2" />
                            Edit
                        </a>
                    </x-table.table-body>
                </tr>
            </x-slot>
        </x-table.table>
    </div>
</div>
