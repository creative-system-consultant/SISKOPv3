<div x-data="{ openModal : false }">
    <x-table.table>
        <x-slot name="thead">
            <x-table.table-header class="text-left" value="No" sort="" />
            <x-table.table-header class="text-left" value="Applicant Name" sort="" />
            <x-table.table-header class="text-left" value="IC No." sort="" />
            <x-table.table-header class="text-left" value="Product Name" sort="" />
            <x-table.table-header class="text-left" value="Apply Amount" sort="" />
            <x-table.table-header class="text-left" value="Apply Date" sort="" />
            <x-table.table-header class="text-left" value="Application Status" sort="" />
            <x-table.table-header class="text-left" value="Action" sort="" />
        </x-slot>
        <x-slot name="tbody">
            @forelse ($financing as $key => $item)
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $loop->iteration }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $item->customer->name }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $item->customer->icno }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $item->product->name }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        RM {{ $item->purchase_price }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $item->created_at->format("d-m-Y") }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        {{ $item->status->description }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        <div class="row">
                            <button
                                wire:click="showApplication('{{ $item->uuid }}')"
                                @click="openModal = true"
                                class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-green-500 rounded-full hover:bg-green-400" title="Show Application">
                                <x-heroicon-o-eye class="w-5 h-5"/>
                            </button>

                            @if ($item->account_status > 15 && in_array($item->current_approval()?->group_id,$User->role_ids()) && $item->current_approval()?->rolegroup->role_id == 1)
                                <a href="{{ route('financing.maker', $item->uuid) }}"
                                   class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400"
                                   title="Approval Process">
                                    <x-heroicon-s-arrow-circle-right class="w-5 h-5"/>
                                </a>
                            @endif

                            @if ($item->account_status > 15 && in_array($item->current_approval()?->group_id,$User->role_ids()) && $item->current_approval()?->rolegroup->role_id == 2)
                                <a href="{{ route('financing.checker', $item->uuid) }}"
                                   class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400"
                                   title="Approval Process">
                                    <x-heroicon-s-arrow-circle-right class="w-5 h-5"/>
                                </a>
                            @endif

                            @if ($item->account_status > 15 && in_array($item->current_approval()?->group_id,$User->role_ids()) && $item->current_approval()?->rolegroup->role_id == 3)
                                <a href="{{ route('financing.committee', $item->uuid) }}"
                                   class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400"
                                   title="Approval Process">
                                    <x-heroicon-s-arrow-circle-right class="w-5 h-5"/>
                                </a>
                            @endif

                            @if ($item->account_status > 15 && in_array($item->current_approval()?->group_id,$User->role_ids()) && $item->current_approval()?->rolegroup->role_id == 4)
                                <a href="{{ route('financing.approver', $item->uuid) }}"
                                   class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400"
                                   title="Approval Process">
                                    <x-heroicon-s-arrow-circle-right class="w-5 h-5"/>
                                </a>
                            @endif
                        </div>
                    </x-table.table-body>
                </tr>
            @empty
                <x-table.table-body colspan="4" class="text-left">
                    No Financing Data
                </x-table.table-body>
            @endforelse
        </x-slot>
    </x-table.table>
    <x-modal.modal modalActive="openModal" title="Apply Financing Application" modalSize="7xl" closeBtn="yes">
        @include('livewire.page.application.application-list.apply_financing')
    </x-modal.modal>
</div>