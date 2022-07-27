<div>
    <x-table.table>
        <x-slot name="thead">
            <x-table.table-header class="text-left " value="No" sort="" />
            <x-table.table-header class="text-left " value="Applicant Name" sort="" />
            <x-table.table-header class="text-left" value="IC No." sort="" />
            <x-table.table-header class="text-left" value="Apply Amount" sort="" />
            <x-table.table-header class="text-left" value="Total Contribution" sort="" />
            <x-table.table-header class="text-left" value="Account No." sort="" />
            <x-table.table-header class="text-left" value="Bank Name" sort="" />
            <x-table.table-header class="text-left" value="Apply Date" sort="" />
            <x-table.table-header class="text-left" value="Application Status" sort="" />
            <x-table.table-header class="text-left" value="Action" sort="" />
        </x-slot>
        <x-slot name="tbody">
            @forelse ($withdrawal as $withdraw)
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $loop->iteration }}        
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        {{ $withdraw->customer->name }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $withdraw->customer->icno }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        RM {{ $withdraw->apply_amt == '0.00' ? '0.00' : $withdraw->apply_amt}}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        RM {{ $withdraw->amt_before == '0.00' ? '0.00' : $withdraw->amt_before }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        {{ $withdraw->bank_account }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        @foreach ($banks as $bank)
                            @if ($bank->code == $withdraw->bank_code) {{ $bank->description }} @endif                            
                        @endforeach
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $withdraw->created_at->format("Y-m-d") }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        @if ($withdraw->flag == '0') Still being applied
                        @elseif ($withdraw->flag == '1') Being Processed
                        @elseif ($withdraw->flag == '3') Failed / Decline 
                        @elseif ($withdraw->flag == '6') Approved                      
                        @endif             
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        <div class="row">
                            <button  
                                wire:click="showApplication('{{$withdraw->uuid}}')"
                                @click="openModal = true"
                                class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-green-500 rounded-full hover:bg-green-400" title="Show Application">
                                <x-heroicon-o-eye class="w-5 h-5"/>
                            </button>

                            <a href="{{route('withdrawal.maker', $withdraw->uuid)}}" class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400" title="Approval Process">
                                <x-heroicon-s-arrow-circle-right class="w-5 h-5"/>                    
                            </a>
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
    <x-modal.modal modalActive="openModal" title="Withdrawal Contribution Application" modalSize="7xl" closeBtn="yes">
        @include('livewire.page.application.application-list.apply_withdraw_contribution')
    </x-modal.modal>
</div>