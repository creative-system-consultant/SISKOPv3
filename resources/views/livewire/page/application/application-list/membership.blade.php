<div class="p-4">
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left " value="No." sort="" />
                <x-table.table-header class="text-left " value="Applicant Name" sort="" />
                <x-table.table-header class="text-left " value="IC NO." sort="" />
                <x-table.table-header class="text-left" value="Register Fee" sort="" />
                <x-table.table-header class="text-left" value="Share Fee" sort="" />
                <x-table.table-header class="text-left" value="Apply Date" sort="" />
                <x-table.table-header class="text-left" value="Application Status" sort="" />
                <x-table.table-header class="text-left" value="Action" sort="" />
            </x-slot>
            <x-slot name="tbody">
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        1
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left uppercase">
                        {{ $Cust->name }} 
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $Cust->icno }} 
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $applymember->register_fee }} 
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $applymember->share_fee }} 
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $applymember->created_at->format("Y-m-d")  }} 
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
                            <a href="{{route('membership.apply', $applymember->uuid)}}" class="inline-flex items-center px-2 py-2 text-sm font-bold text-white bg-blue-500 rounded-full hover:bg-blue-400" title="Approval Process">
                                <x-heroicon-s-arrow-circle-right class="w-5 h-5"/>                    
                            </a>
                        </div>
                    </x-table.table-body>
                </tr>
            </x-slot>
        </x-table.table>
</div>
          