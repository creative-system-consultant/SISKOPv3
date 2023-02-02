<div x-data="{ openModal: false }">
    <x-table.table>
        <x-slot name="thead">
            <x-table.table-header class="text-left " value="No" sort="" />
            <x-table.table-header class="text-left " value="Applicant Name" sort="" />
            <x-table.table-header class="text-left" value="IC No." sort="" />
            <x-table.table-header class="text-left" value="Payment Method" sort="" />
            <x-table.table-header class="text-left" value="Apply Amount" sort="" />
            <x-table.table-header class="text-left" value="Approved Amount" sort="" />
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
                    <x-table.table-body colspan="" class="text-left">
                        {{ $item->customer->icno }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        @if ($item->step == 1 && $item->flag == 1)
                            {{ $item->method }}
                        @endif
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        RM {{ $item->apply_amt == '0.00' ? '0.00' : $item->apply_amt }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        RM {{ $item->approved_amt }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $item->created_at->format("Y-m-d") }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        @if ($item->flag == '0') Still being applied
                        @elseif ($item->flag == '1') Being Processed
                        @elseif ($item->flag == '3') Failed / Decline
                        @elseif ($item->flag == '6') Approved
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
                            <a href="{{ route('share.maker', $item->uuid) }}"
                               class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400"
                               title="Approval Process">
                                <x-heroicon-s-arrow-circle-right class="w-5 h-5"/>
                            </a>
                        @endif

                        @if ($item->flag > 0 && in_array($item->current_approval()?->group_id,$User->role_ids()) && $item->current_approval()?->role_id == 2)
                            <a href="{{ route('share.checker', $item->uuid) }}"
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
                No Share Data
            </x-table.table-body>
            @endforelse
        </x-slot>
    </x-table.table>

    <x-modal.modal modalActive="openModal" title="Add Share Application" modalSize="7xl" closeBtn="yes">
        @include('livewire.page.application.application-list.apply_share')
    </x-modal.modal>
</div>