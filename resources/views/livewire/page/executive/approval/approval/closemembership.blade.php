{{-- <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Close Membership Information</h2> --}}
<div>
    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Membership Information</h2>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-2">
        <x-form.input
            label="Total Contribution"
            name=""
            value="{{ $Application->customer->fmsMembership->total_contribution }}"
            mandatory=""
            disable="true"
            type="text"
        />
        <x-form.input
            label="Total Share"
            name=""
            value="{{ $Application->customer->fmsMembership->total_share }}"
            mandatory=""
            disable="true"
            type="text"
        />
        <x-form.input
            label="Balance Outstanding"
            name=""
            value=""
            mandatory=""
            disable="true"
            type="text"
        />
    </div>
</div>
<div>
    <h2 class="my-4 text-base font-semibold border-b-2 border-gray-300">List of Account of Applicant</h2>
    <div>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left" value="Acc No" sort="" />
                <x-table.table-header class="text-left" value="Start Disbursed Date" sort="" />
                <x-table.table-header class="text-right" value="Duration" sort="" />
                <x-table.table-header class="text-left" value="Closed Date" sort="" />
                <x-table.table-header class="text-right" value="Bal Outstanding" sort="" />
                <x-table.table-header class="text-right" value="Month Arrears" sort="" />
                <x-table.table-header class="text-right" value="Instal Arrears" sort="" />
            </x-slot>
            <x-slot name="tbody">
                @forelse($acctApplicants as $acctApplicant)
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $acctApplicant->account_no }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $acctApplicant->start_disbursed_date }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-right">
                        {{ $acctApplicant->duration }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $acctApplicant->closed_date }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-right">
                        {{ $acctApplicant->bal_outstanding }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-right">
                        {{ $acctApplicant->month_arrears }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-right">
                        {{ $acctApplicant->instal_arrears }}
                    </x-table.table-body>
                </tr>
                @empty
                <tr>
                    <x-table.table-body colspan="9" class="text-center">
                        No Data
                    </x-table.table-body>
                </tr>
                @endforelse
            </x-slot>
        </x-table.table>
    </div>

    <h2 class="my-4 text-base font-semibold border-b-2 border-gray-300">List of Guarantee</h2>
    <div>
        <x-table.table>
            <x-slot name="thead">
                <x-table.table-header class="text-left" value="Start Disbursed Date" sort="" />
                <x-table.table-header class="text-right" value="Duration" sort="" />
                <x-table.table-header class="text-left" value="Closed Date" sort="" />
                <x-table.table-header class="text-right" value="Bal Outstanding" sort="" />
                <x-table.table-header class="text-right" value="Month Arrears" sort="" />
                <x-table.table-header class="text-right" value="Instal Arrears" sort="" />
            </x-slot>
            <x-slot name="tbody">
                @forelse($guarantorLists as $guarantorList)
                <tr>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $guarantorList->start_disbursed_date }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-right">
                        {{ $guarantorList->duration }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-left">
                        {{ $guarantorList->closed_date }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-right">
                        {{ $guarantorList->bal_outstanding }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-right">
                        {{ $guarantorList->month_arrears }}
                    </x-table.table-body>
                    <x-table.table-body colspan="" class="text-right">
                        {{ $guarantorList->instal_arrears }}
                    </x-table.table-body>
                </tr>
                @empty
                <tr>
                    <x-table.table-body colspan="9" class="text-center">
                        No Data
                    </x-table.table-body>
                </tr>
                @endforelse
            </x-slot>
        </x-table.table>
    </div>

    <div class="grid grid-cols-12 gap-6 mt-4">
        <div class="col-span-12 mb-4 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
            <x-form.input-tag label="Reason" type="text" name="Application.terminate_reason" value="{{ $Application->terminate_reason }}" leftTag="" rightTag="" mandatory="" disable="true" />
        </div>
    </div>
</div>
