<div x-data="{ openModal: false }" wire:poll.30000ms>
    <x-table.table>
        <x-slot name="thead">
            <x-table.table-header class="text-left" value="No" sort="" />
            <x-table.table-header class="text-left" value="Seller" sort="" />
            <x-table.table-header class="text-left" value="Buyer" sort="" />
            <x-table.table-header class="text-right" value="Apply Amount (RM)" sort="" />
            <x-table.table-header class="text-right" value="Approved Amount (RM)" sort="" />
            <x-table.table-header class="text-left" value="Apply Date" sort="" />
            <x-table.table-header class="text-left" value="Application Status" sort="" />
            <x-table.table-header class="text-left" value="Action" sort="" />
        </x-slot>
        <x-slot name="tbody">
            @forelse ($shares as $item)
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $loop->iteration }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        {{ $item->customer->name }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        {{ $item->exc_cust_id == NULL ? '' : $item->buyer->name }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-right uppercase">
                        {{ $item->apply_amt == '0.00' ? '0.00' : $item->apply_amt }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-right uppercase">
                        {{ $item->approved_amt }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $item->created_at->format("d-m-Y") }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        @if ($item->flag == '1') Being Processed
                        @elseif ($item->flag == '20') Approved
                        @elseif ($item->flag > '20') Failed / Rejected
                        @endif
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        <div class="row">
                            <button
                                wire:click="showApplication('{{ $item->uuid }}')"
                                @click="openModal = true"
                                class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-green-500 rounded-full hover:bg-green-400" title="Show Application">
                                <x-heroicon-o-eye class="w-5 h-5"/>
                            </button>

                        @if ($item->flag > 0 && in_array($item->current_approval()?->group_id,$User->role_ids()) && $item->current_approval()?->role_id == 1)
                            <a href="{{ route('allapproval.maker',['include' => 'exchangeshare','uuid' => $item->uuid]) }}"
                               class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400"
                               title="Approval Process">
                                <x-heroicon-s-arrow-right-circle class="w-5 h-5"/>
                            </a>
                        @endif

                        @if ($item->flag > 0 && in_array($item->current_approval()?->group_id,$User->role_ids()) && $item->current_approval()?->role_id == 2)
                            <a href="{{ route('allapproval.checker',['include' => 'exchangeshare', 'uuid' => $item->uuid]) }}"
                               class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400"
                               title="Approval Process">
                                <x-heroicon-s-arrow-right-circle class="w-5 h-5"/>
                            </a>
                        @endif

                        @if ($item->flag > 0 && in_array($User->id,$item->approval_unvoted_id(3)))
                            <a href="{{ route('allapproval.committee',['include' => 'exchangeshare', 'uuid' => $item->uuid]) }}"
                               class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400"
                               title="Approval Process">
                                <x-heroicon-s-arrow-right-circle class="w-5 h-5"/>
                            </a>
                        @endif

                        @if ($item->flag > 0 && in_array($User->id,$item->approval_unvoted_id(4)))
                            <a href="{{ route('allapproval.approver',['include' => 'exchangeshare', 'uuid' => $item->uuid]) }}"
                               class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400"
                               title="Approval Process">
                                <x-heroicon-s-arrow-right-circle class="w-5 h-5"/>
                            </a>
                        @endif

                        @if ($item->flag > 0 && in_array($item->current_approval()?->group_id,$User->role_ids()) && $item->current_approval()?->role_id == 5)
                            <a href="{{ route('allapproval.approver',['include' => 'exchangeshare','uuid' => $item->uuid]) }}"
                               class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400"
                               title="Approval Process">
                                <x-heroicon-s-arrow-right-circle class="w-5 h-5"/>
                            </a>
                        @endif

                        </div>
                    </x-table.table-body>
                </tr>
            @empty
            <x-table.table-body colspan="4" class="text-left">
                No Share Data
            </x-table.table-body>
            @endforelse
        </x-slot>
    </x-table.table>
    <div class="mt-4">
        {{ $shares->links('livewire::pagination-links') }}
    </div>
    <x-modal.modal modalActive="openModal" title="Transfer Share Approval" modalSize="7xl" closeBtn="yes" closeFn="clearApplication">
        @include('livewire.page.application.application-list.details.exchangeshare')
    </x-modal.modal>
</div>
