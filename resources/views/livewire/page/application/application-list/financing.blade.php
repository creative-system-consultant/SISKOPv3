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
                        {{ $item->customers->name }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $item->customers->icno }}
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
                        @if ($item->apply_step == '0') Still being applied
                            @elseif ($item->apply_step == '1') Being Processed
                            @elseif ($item->apply_step == '3') Failed / Decline    
                            @elseif ($item->apply_step == '6') Approved                    
                            @endif
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        <div class="row">
                            <button  
                                wire:click="showApplication('{{$item->uuid}}')"
                                @click="openModal = true"
                                class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-green-500 rounded-full hover:bg-green-400" title="Show Application">
                                <x-heroicon-o-eye class="w-5 h-5"/>
                            </button>

                            {{-- <a href="{{route('contribution.maker', $cont->uuid)}}" class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400" title="Approval Process">
                                <x-heroicon-s-arrow-circle-right class="w-5 h-5"/>                    
                            </a> --}}
                        </div>
                    </x-table.table-body>
            </tr>
            @empty
                <x-table.table-body colspan="4" class="text-left">
                    No Data                    
                </x-table.table-body>
            @endforelse
        </x-slot>
    </x-table.table>
    <x-modal.modal modalActive="openModal" title="Apply Financing Application" modalSize="7xl" closeBtn="yes">
        @include('livewire.page.application.application-list.apply_financing')
    </x-modal.modal>
</div>