<div x-show="active == 7">
    <div  class="px-6 py-4 mt-4">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Checklist Details</h2>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left " value="Files" sort="" />
                <x-table.table-header class="text-left" value="" sort="" />
                <x-table.table-header class="text-left" value="" sort="" />
            </x-slot>

            <x-slot name="tbody" wire:poll.5s>
                @foreach($applymember->files as $file)
                <tr>
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

        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" wire:click="previous" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                    Previous
                </button>
                {{-- <button type="button" wire:click="callSP" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-yellow-500 rounded-md focus:outline-none">
                    Call SP
                </button> --}}
                @if (($applymember->flag!=1 && !$applyStatus) || !$applyStatus)

                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Submit
                </button>
                @endif
            </div>
        </div>
    </div>
</div>