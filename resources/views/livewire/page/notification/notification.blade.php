<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Notification List</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left " value="No" sort="" />
                <x-table.table-header class="text-left " value="Title" sort="" />
                <x-table.table-header class="text-left" value="Description" sort="" />
                <x-table.table-header class="text-left" value="Action" sort="" />
            </x-slot>
            <x-slot name="tbody">
                @if ($specialAid != NULL)
                    @foreach ($specialAid->notification as $notifyAid)
                        <tr>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $loop->iteration }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $notifyAid->title }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{ $notifyAid->description }}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                <a href="{{ url($notifyAid->link) }}" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded">
                                    Apply
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" class="w-4 h-4 ml-2" fill="white"><path d="M342.6 182.6C336.4 188.9 328.2 192 319.1 192s-16.38-3.125-22.62-9.375L224 109.3V432c0 44.13-35.89 80-80 80H32c-17.67 0-32-14.31-32-32s14.33-32 32-32h112C152.8 448 160 440.8 160 432V109.3L86.62 182.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l127.1-128c12.5-12.5 32.75-12.5 45.25 0l128 128C355.1 149.9 355.1 170.1 342.6 182.6z"/></svg>
                                </a>
                            </x-table.table-body>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <x-table.table-body colspan="3" class="text-left">
                            No Notification
                        </x-table.table-body>
                    </tr>
                @endif
            </x-slot>
        </x-table.table>
    </x-general.card>
</div>
