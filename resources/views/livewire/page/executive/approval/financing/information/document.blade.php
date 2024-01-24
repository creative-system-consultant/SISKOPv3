<h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Document Information</h2>
<x-table.table>
    <x-slot name="thead">
        <x-table.table-header class="text-left " value="Files" sort="" />
        <x-table.table-header class="text-left" value="" sort="" />
        <x-table.table-header class="text-left" value="" sort="" />
    </x-slot>
    <x-slot name="tbody">
        {{-- @foreach($Application->files as $file) --}}
        <tr>
            <x-table.table-body colspan="" class="text-left">
                file Name
            </x-table.table-body>
            <x-table.table-body colspan="" class="text-left">
                <a href=" " target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded hover:bg-orange-400">
                    <x-heroicon-o-eye class="w-4 h-4 mr-2"/>
                    Show
                </a>
            </x-table.table-body>
        </tr>
        {{-- @endforeach --}}
    </x-slot>
</x-table.table>