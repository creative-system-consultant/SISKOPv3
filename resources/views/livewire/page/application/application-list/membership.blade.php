<div class="p-4">
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left " value="No." sort="" />
                <x-table.table-header class="text-left " value="Applicant Name" sort="" />
                <x-table.table-header class="text-left " value="IC NO." sort="" />
                <x-table.table-header class="text-left" value="Register Fee" sort="" />
                <x-table.table-header class="text-left" value="Share Fee" sort="" />
                <x-table.table-header class="text-left" value="Contribution Fee" sort="" />
                <x-table.table-header class="text-left" value="Apply Date" sort="" />
                <x-table.table-header class="text-left" value="Application Status" sort="" />
                <x-table.table-header class="text-left" value="Action" sort="" />
            </x-slot>
            <x-slot name="tbody">
                @forelse ($membership as $key => $applymember)
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $loop->iteration }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        {{ $applymember->customer->name }} 
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $applymember->customer->icno }} 
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        RM {{ $applymember->register_fee == NULL ? '0.00' : $applymember->register_fee }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        RM {{ $applymember->share_fee == NULL ? '0.00' : $applymember->share_fee }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        RM {{ $applymember->contribution_fee == NULL ? '0.00' : $applymember->contribution_fee }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $applymember->created_at->format("d-m-Y")  }} 
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        @if ($applymember->flag == '0') Still being applied
                        @elseif ($applymember->flag == '1') Being Processed
                        @elseif ($applymember->flag == '3') Failed / Decline    
                        @elseif ($applymember->flag == '6') Approved                    
                        @endif             
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        <div class="row">
                            <button  
                            wire:click="showApplication('{{$applymember->uuid}}')"
                            @click="openModal = true"
                            class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-green-500 rounded-full hover:bg-green-400" title="Show Application">
                            <x-heroicon-o-eye class="w-5 h-5"/>
                        </button>
                            {{-- <a href="{{route('membership.apply', $applymember->uuid)}}" class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400" title="Approval Process">
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
        <x-modal.modal modalActive="openModal" title="Add Contribution Application" modalSize="7xl" closeBtn="yes">
            @include('livewire.page.application.application-list.apply_membership')
        </x-modal.modal>
</div>
          