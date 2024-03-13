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
                                <a class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md cursor-pointer hover:bg-blue-600 focus:outline-none" wire:click='searchGuarantor("{{$item->account_no}}")'>
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
                        <th  colspan="6" class="px-6 py-3 text-sm font-medium leading-4 tracking-wider text-center uppercase border bg-primary-100 dark:bg-gray-600 dark:text-white" >
                            List Of Guarantors of Account No : {{ $this->acct_no }}
                        </th>
                    </tr>
                    <tr  class="">
                        <th  colspan="3" class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center uppercase bg-white border dark:bg-gray-600 dark:text-white" >
                            Current
                        </th>
                        <th  colspan="3" class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center uppercase bg-white border dark:bg-gray-600 dark:text-white" >
                            New
                        </th>
                    </tr>
                    <tr>
                        <th  colspan="1" class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center uppercase border bg-gray-50 dark:bg-gray-600 dark:text-white" >
                            Membership Number
                        </th>
                        <th  colspan="1" class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center uppercase border bg-gray-50 dark:bg-gray-600 dark:text-white" >
                            NRIC
                        </th>
                        <th  colspan="1" class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left uppercase border bg-gray-50 dark:bg-gray-600 dark:text-white" >
                            Name
                        </th>
                        <th  colspan="1" class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center uppercase bg-gray-100 border dark:bg-gray-600 dark:text-white" >
                            Membership Number
                        </th>
                        <th  colspan="1" class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-center uppercase bg-gray-100 border dark:bg-gray-600 dark:text-white" >
                            NRIC
                        </th>
                        <th  colspan="1" class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left uppercase bg-gray-100 border dark:bg-gray-600 dark:text-white" >
                            Name
                        </th>
                    </tr>
                </x-slot>
                <x-slot name="tbody">
                    @if($guarantor)
                        @foreach ($guarantor as $index => $item)
                            <tr>
                                <td  width="5%" class="px-6 py-2 text-xs leading-5 text-center whitespace-no-wrap bg-white border dark:bg-gray-700 dark:text-white">
                                    {{$item->fmsMembership->mbr_no}}
                                </td>
                                <td  width="15%" class="px-6 py-2 text-xs leading-5 text-center whitespace-no-wrap bg-white border dark:bg-gray-700 dark:text-white">
                                    {{$item->fmsMembership->fmsCustomer->identity_no}}
                                </td>
                                <td  width="30%"  class="px-6 py-2 text-xs leading-5 text-left whitespace-no-wrap bg-white border dark:bg-gray-700 dark:text-white">
                                    {{$item->fmsMembership->fmsCustomer->name}}
                                </td>
                                <td  width="5%" class="px-6 py-2 text-xs leading-5 text-center whitespace-no-wrap bg-white border dark:bg-gray-700 dark:text-white">
                                    <x-form.input
                                        label=""
                                        name=""
                                        value=""
                                        mandatory=""
                                        disable="readonly"
                                        type="text"
                                        wire:model="mbrNos.{{ $index }}"
                                    />
                                </td>
                                <td  width="15%" class="px-6 py-2 text-xs leading-5 text-center whitespace-no-wrap bg-white border dark:bg-gray-700 dark:text-white">
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
                                </td>
                                <td  width="30%" class="px-6 py-2 text-xs leading-5 text-center whitespace-no-wrap bg-white border dark:bg-gray-700 dark:text-white">
                                    <x-form.input
                                        label=""
                                        name=""
                                        value=""
                                        mandatory=""
                                        disable="readonly"
                                        type="text"
                                        wire:model="names.{{ $index }}"
                                    />
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </x-slot>
            </x-table.table>
        </div>
        @endif

        <div>
            <div class="grid grid-cols-1 gap-4 mt-10 lg:grid-cols-3">
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
            <div class="grid grid-cols-1 gap-4 mt-4 lg:grid-cols-2">
                <x-form.text-area
                    label="Other Reasons : ({{ strlen($reasonChangeTxt) }}/255)"
                    value=""
                    name=""
                    rows=""
                    disable=""
                    mandatory=""
                    placeholder=""
                    wire:model="reasonChangeTxt"
                />
            </div>
            @endif

            <div class="p-4 mt-10 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button wire:click="alertConfirm" type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Submit
                    </button>

                </div>
            </div>
        </div>

    </x-general.card>
</div>

@push('js')
<script>
    window.addEventListener('swal:confirm', event => {
        swal.fire({
            icon: event.detail.type,
            title: event.detail.text,
            showCancelButton: true,
            cancelButtonText: 'Cancel'
        }).then(function(result){
            if(result.isConfirmed){
                window.Livewire.emit('submit');
            }
        });
    });
</script>
@endpush
