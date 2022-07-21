<x-table.table>
    <x-slot name="thead">
        <x-table.table-header class="text-left " value="No" sort="" />
        <x-table.table-header class="text-left " value="Applicant Name" sort="" />
        <x-table.table-header class="text-left" value="IC No." sort="" />
        <x-table.table-header class="text-left" value="Payment Method" sort="" />
        <x-table.table-header class="text-left" value="Apply Amount" sort="" />
        <x-table.table-header class="text-left" value="Apply Date" sort="" />
        <x-table.table-header class="text-left" value="Application Status" sort="" />
        <x-table.table-header class="text-left" value="Action" sort="" />
    </x-slot>
    <x-slot name="tbody">
        @forelse ($contribution as $cont)
            <tr>
                <x-table.table-body colspan="" class="text-left">
                    {{ $loop->iteration }}        
                </x-table.table-body>
                <x-table.table-body colspan="" class="text-left uppercase">
                    {{ $cont->customer->name }}
                </x-table.table-body>
                <x-table.table-body colspan="" class="text-left">
                    {{ $cont->customer->icno }}
                </x-table.table-body>
                <x-table.table-body colspan="" class="text-left uppercase">
                    @if ($cont->step == 1 && $cont->flag == 1)
                        {{ $cont->start_apply != NULL ? 'Starting Date' : 'One Month' }}                        
                    @endif
                </x-table.table-body>
                <x-table.table-body colspan="" class="text-left uppercase">
                    RM {{ $cont->apply_amt == '0.00' ? '0.00' : $cont->apply_amt }}
                </x-table.table-body>
                <x-table.table-body colspan="" class="text-left">
                    {{ $cont->created_at->format("Y-m-d") }}
                </x-table.table-body>
                <x-table.table-body colspan="" class="text-left uppercase">
                    @if ($cont->flag == '0') Still being applied
                    @elseif ($cont->flag == '1') Being Processed
                    @elseif ($cont->flag == '3') Failed / Decline    
                    @elseif ($cont->flag == '6') Approved                    
                    @endif             
                </x-table.table-body>
                <x-table.table-body colspan="" class="text-left">
                    <a href="{{ route('application.contribution', $cont->uuid) }}" class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-green-500 rounded-full hover:bg-green-400" title="Show Application">
                        <x-heroicon-o-eye class="w-5 h-5"/>
                    </a>
                </x-table.table-body>
            </tr>  
        @empty
        <x-table.table-body colspan="4" class="text-left">
            No Data                    
        </x-table.table-body>
        @endforelse
    </x-slot>
</x-table.table>