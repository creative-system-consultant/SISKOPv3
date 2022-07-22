<div x-data="{ openModal : false }">
    <x-table.table>
        <x-slot name="thead">
            <x-table.table-header class="text-left " value="No" sort="" />
            <x-table.table-header class="text-left " value="Seller" sort="" />
            <x-table.table-header class="text-left" value="Buyer" sort="" />
            <x-table.table-header class="text-left" value="Apply Amount" sort="" />
            <x-table.table-header class="text-left" value="Approved Amount" sort="" />
            <x-table.table-header class="text-left" value="Apply Date" sort="" />
            <x-table.table-header class="text-left" value="Application Status" sort="" />
            <x-table.table-header class="text-left" value="Action" sort="" />
        </x-slot>
        <x-slot name="tbody">
            @forelse ($sellShare as $sell)
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $loop->iteration }}        
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        {{ $sell->customer->name }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        {{ $sell->exc_cust_id == NULL ? 'Co-operative' : $sell->buyer->name }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        RM {{ $sell->apply_amt }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        RM {{ $sell->approved_amt == '0.00' ? '0.00' : $sell->approved_amt }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $sell->created_at->format("Y-m-d") }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        @if ($sell->flag == '0') Still being applied
                        @elseif ($sell->flag == '1')
                            @if ($sell->step == '1') Waiting for Buyer
                            @elseif ($sell->step == '2') Being processed                    
                            @endif
                        @elseif ($sell->flag == '3') Failed / Decline                    
                        @elseif ($sell->flag == '6' && $sell->step == '3') Approved
                        @endif             
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        <button  
                            wire:click="showApplication('{{$sell->uuid}}')"
                            @click="openModal = true"
                            class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-green-500 rounded-full hover:bg-green-400" title="Show Application">
                            <x-heroicon-o-eye class="w-5 h-5"/>
                        </button>
                    </x-table.table-body>
                </tr>  
            @empty
            <x-table.table-body colspan="4" class="text-left">
                No Data                    
            </x-table.table-body>
            @endforelse
        </x-slot>
    </x-table.table>
    <x-modal.modal modalActive="openModal" title="Share Reimbursement Application" modalSize="7xl" closeBtn="yes">
        @include('livewire.page.application.application-list.apply_sell_exchange_share')
    </x-modal.modal>
</div>