<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Change Guarantor</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md ">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Please fill in the information</h2>
        <div>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left " value="Account Number" sort="" />
                    <x-table.table-header class="text-left" value="Product Name" sort="" />
                    <x-table.table-header class="text-right" value="Financing Amount" sort="" />
                    <x-table.table-header class="text-right" value="Balance Outstanding" sort="" />
                    <x-table.table-header class="text-center" value="Action" sort="" />
                </x-slot>
                <x-slot name="tbody">
                    @forelse($acct_position as $item)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            {{$item->account_no}}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{$item->master->product->name}}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-right">
                            {{number_format($item->master->selling_price,2)}}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-right">
                            {{number_format($item->bal_outstanding,2)}}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="">
                            <div class="flex items-center justify-center space-x-2">
                                <a class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 hover:bg-blue-600 rounded-md focus:outline-none" wire:click='searchGuarantor("{{$item->account_no}}")'>
                                    <x-heroicon-o-cursor-arrow-rays class="w-4 h-4" />
                                    Please Choose
                                </a>
                            </div>
                        </x-table.table-body>
                    </tr>
                    @empty
                        <tr>
                            <x-table.table-body colspan="4" class="text-center">
                                No Data
                            </x-table.table-body>
                        </tr>
                    @endforelse
                </x-slot>
            </x-table.table>
        </div>
        @if($clicked!=0)
        <div class="mt-10">
            <x-table.table>
                <x-slot name="thead">
                    <tr  class="">
                        <th  colspan="3" class="px-6 py-3 border bg-primary-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            List of Guarantors
                        </th>
                        <th  colspan="3" class="px-6 py-3 border bg-primary-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            New Guarantor
                        </th>
                    </tr>
                    <tr>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            Membership Number
                        </th>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            NRIC of the Current Guarantor
                        </th>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            Current Guarantor Name
                        </th>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            Membership Number
                        </th>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            NRIC of the New Guarantor
                        </th>
                        <th  colspan="1" class="px-6 py-3 border bg-gray-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center" >
                            New Guarantor Name
                        </th>
                    </tr>
                    
                </x-slot>
                <x-slot name="tbody">
                    @if($guarantor)

                    
                        
                    @foreach ($guarantor as $index => $item)
                    <tr>
                        <x-table.table-body colspan="" class="border text-center text-xs">
                            {{$item->fmsMembership->mbr_no}}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="border text-center text-xs">
                            {{$item->fmsMembership->fmsCustomer->identity_no}}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="border text-center text-xs">
                            {{$item->fmsMembership->fmsCustomer->name}}
                        </x-table.table-body>
                        
                        <x-table.table-body colspan="" class="border text-center">
                            <x-form.input
                                label=""
                                name=""
                                value=""
                                mandatory=""
                                disable="readonly"
                                type="text"
                                wire:model="mbrNos.{{ $index }}"
                            />
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="border">
                            <x-form.input
                                label=""
                                name="searchNRIC.{{$index}}"
                                value=""
                                mandatory=""
                                disable=""
                                wire:keyup="searchUser({{ $index }})"
                                wire:model="searchNRIC.{{ $index }}"
                                type="text"
                            />
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="border">
                            <x-form.input
                                label=""
                                name=""
                                value=""
                                mandatory=""
                                disable="readonly"
                                type="text"
                                wire:model="names.{{ $index }}"

                            />
                        </x-table.table-body>
                    </tr>

                    @endforeach
                    @endif

                </x-slot>
            </x-table.table>
        </div>
        @endif

        <div>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-10">
                <div>
                    <x-form.dropdown
                        label="Reason for Changing Guarantor"
                        value=""
                        name=""
                        id=""
                        mandatory=""
                        disable=""
                        default="yes"
                        wire:model="reasonChange"
                    >
                        <option value="Berhenti Ahli"> Resignation of Member </option>
                        <option value="Berhenti Kerja"> Resignation from Work </option>
                        <option value="Lain-lain"> Others (please fill the form below) </option>
                    </x-form.dropdown>
                </div>
            </div>

            @if($reasonChange =="Lain-lain")
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
                <x-form.text-area
                    label="Other Reasons : ({{ strlen($reasonChangeTxt) }}/255)"
                    value=""
                    name=""
                    rows=""
                    disable=""
                    mandatory=""
                    placeholder=""
                    wire:model.lazy="reasonChangeTxt"
                />
            </div>
            @endif

            <div class="p-4 mt-10 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button wire:click="submit()" type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Submit
                    </button>
                </div>
            </div>

        </div>
    </x-general.card>
</div>
