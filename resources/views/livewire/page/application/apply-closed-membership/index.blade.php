<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Close Membership</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md ">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Please fill in the information</h2>
            <div class="grid grid-cols-12 gap-2">
                <div class="col-span-12 sm:col-span-12 lg:col-span-5">
                    <x-form.input
                        label="Full Name"
                        name=""
                        value="{{$fms_cust->name}}"
                        mandatory=""
                        disable="readonly"
                        type="text"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                    <x-form.input
                        label="NRIC"
                        name=""
                        value="{{$fms_cust->identity_no}}"
                        mandatory=""
                        disable="readonly"
                        type="text"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 lg:col-span-3">
                    <x-form.input
                        label="Email"
                        name=""
                        value="{{$fms_cust->email}}"
                        mandatory=""
                        disable="readonly"
                        type="text"
                    />
                </div>
                <div class="col-span-12 sm:col-span-12 lg:col-span-2">
                    <x-form.input-tag
                        label="Balance Outstanding"
                        type="text"
                        name=""
                        value="{{number_format($balance_outstanding,2)}}"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="readonly"
                    />
                </div>
            </div>

            <h2 class="my-4 text-base font-semibold border-b-2 border-gray-300">List of Guarantee</h2>
            <div>
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left " value="Loan Account Number" sort="" />
                        <x-table.table-header class="text-left" value="Borrower(s) Name" sort="" />
                        <x-table.table-header class="text-left" value="NRIC" sort="" />
                        <x-table.table-header class="text-right" value="Balance Outstanding" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse($jaminan as $item)
                        <tr>
                            <x-table.table-body colspan="" class="text-left">
                                {{$item->account_no}}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{$item->guarantee_name}}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-left">
                                {{$item->guarantee_icno}}
                            </x-table.table-body>
                            <x-table.table-body colspan="" class="text-right">
                                {{$item->bal_outstanding}}
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
            <x-form.basic-form wire:submit.prevent="alertConfirm" x-data="{types: '', selected: false}">
            @if($guaranteeFlag!=1)

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-10">
         

                <x-form.text-area
                    label="Reason for Closure"
                    value="reason"
                    name="reason"
                    rows=""
                    disable=""
                    mandatory=""
                    placeholder=""
                    wire:model.lazy="reason"
                />

                {{-- <x-form.input
                    label="Muat Naik Dokumen untuk Pengesahan (Jika ada) :"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    type="file"
                /> --}}
            </div>
            @else 
            <div class="p-4 mt-10 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2 text-red-500">
                    You are unable to terminate your membership due to the presence of one or more outstanding guarantees
                </div>
            </div>
            @endif
            
            <div class="p-4 mt-10 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    @if($guaranteeFlag!=1)
                    <button type="submit"  wire:submit.prevent="alertConfirm" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Submit
                    </button>
                    @endif
                </div>
            </div>
        </x-form.basic-form>
        @if (session('error'))
            <x-swall.error  message="{{ session('message') }}"/>
        @elseif (session('info'))
            <x-swall.info  message="{{ session('message') }}"/>
        @elseif (session('success'))
            <x-swall.success message="{{ session('message') }}"/>
        @elseif (session('warning'))
            <x-swall.warning  message="{{ session('message') }}"/>
        @endif
    
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