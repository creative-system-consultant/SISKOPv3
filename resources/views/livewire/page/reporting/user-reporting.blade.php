<div class="p-4">
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4">
            <x-general.header-title title="List Of User" route="{{ route('list-reporting') }}"/>
        </div>
        <div wire:loading wire:target="generateExcel">
            <x-main-loading />
        </div>
            <div class="flex flex-col items-start justify-between px-4 sm:flex-row sm:items-center">
                <div class="flex flex-wrap items-center">
                    <div class="mr-0 md:mr-2">
                        <label class="block text-sm font-semibold leading-5 text-gray-700"  for="report_date">Start Date:</label>
                        <input
                            class="block transition duration-150 ease-in-out form-input sm:text-sm sm:leading-5"
                            type="date"
                            wire:model="startDate"
                        >
                    </div>
                    <div class="mr-0 md:mr-2">
                        <label class="block text-sm font-semibold leading-5 text-gray-700"  for="report_date">End Date:</label>
                        <input
                            class="block transition duration-150 ease-in-out form-input sm:text-sm sm:leading-5"
                            type="date"
                            wire:model="endDate"
                        >
                    </div>
                    <div class="mt-5 mr-0 md:mr-2">
                        <button wire:click="generateExcel" class="inline-flex items-center px-4 py-2 font-semibold text-white bg-green-500 rounded hover:bg-green-600 focus:outline-none" >
                            <x-heroicon-o-document-report class="w-6 h-6 mr-2"/>
                            <span>Excel</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-4 ">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left " value="NO" sort="" />
                        <x-table.table-header class="text-left" value="Name" sort="" />
                        <x-table.table-header class="text-left" value="IC No" sort="" />
                        <x-table.table-header class="text-left" value="Status" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($result as $key => $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $key + 1 }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $item->name }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $item->ICNO }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $item->MARRIED }}
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
                <div class="py-4">
                    {{ $result->links('livewire::tailwind') }}
                </div>
            </div>
    </x-general.card>
</div>