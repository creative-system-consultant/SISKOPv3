<div class="p-4 @if ($numpage != 4) hidden @endif ">
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Checklist </h2>
        <div class="mt-4 bg-white rounded-md">
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-1">
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="No" sort="" />
                        <x-table.table-header class="text-left" value="Documents" sort="" />
                        <x-table.table-header class="text-left" value="Action" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach($Account->files as $file)
                        <tr>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $loop->iteration }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $file->filedesc }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                <a href="{{ asset('storage/'.$file->filepath) }} " target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-orange-400">
                                    <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                                    Show
                                </a>
                            </x-table.table-body>
                        </tr>
                        @endforeach
                    </x-slot>
                </x-table.table>
            </div>
        </div>
        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-yellow-500 rounded-md focus:outline-none">
                    Previous
                </button>
                <button wire:click="deb" type="button" wire:click="back" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-yellow-500 rounded-md focus:outline-none">
                    debug
                </button>
                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Submit
                </button>
            </div>
        </div>

    </x-general.card>
</div>