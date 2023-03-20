<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">COOP Membership</h1>

    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Membership Status</h2>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left" value="NO" sort="" />
                <x-table.table-header class="text-left" value="COOP NAME" sort="" />
                <x-table.table-header class="text-left" value="MEMBERSHIP APPLICATION" sort="" />
                <x-table.table-header class="text-left" value="MEMBERSHIP NUMBER" sort="" />
                <x-table.table-header class="text-left" value="MEMBERSHIP STATUS" sort="" />
                <x-table.table-header class="text-left" value="ACTION" sort="" />
            </x-slot>
            <x-slot name="tbody">
                @forelse ($memberships as $item)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $loop->iteration }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $item->coop->name }} ({{ $item->coop->name2 }})
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            @if($item->flag == '20') APPROVED
                            @endif
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $item->customer->ref_no }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $item->customer->status() }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            <button
                                wire:click="showApplication('{{ $item->uuid }}')"
                                title="Show Application"
                                class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-green-500 rounded-full hover:bg-green-400" >
                                    <x-heroicon-o-eye class="w-5 h-5"/>
                            </button>
                        </x-table.table-body>
                    </tr>
                @empty
                    <tr>
                        <x-table.table-body colspan="4" class="text-left">
                        </x-table.table-body>
                    </tr>
                @endforelse
                    
            </x-slot>
        </x-table.table>
        <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
            <div class="flex items-center justify-center space-x-2">
                <button type="button" wire:click="deb" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Debug
                </button>
            </div>
        </div>
    </x-general.card>
</div>
