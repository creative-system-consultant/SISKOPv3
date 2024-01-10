@isset($custApply)
<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
            <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4">
                <x-form.input
                    label="Name"
                    name="applicant_name"
                    value="{{ $custApply->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input
                    label="IC No."
                    name="applicant_icno"
                    value="{{ $custApply->customer->icno ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input
                    label="Special Aid Type"
                    name="specialAid_type"
                    value="{{ $type->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input
                    label="Apply Amount"
                    name="apply_amt"
                    value="{{ $custApply->apply_amt ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                @foreach ($custApply->field ?? [] as $list)
                    <x-form.input
                        label="{{ $list->label }}"
                        name="{{ $list->name }}"
                        value="{{ $list->value }}"
                        mandatory=""
                        disable="true"
                        type="{{ $list->type }}"
                    />
                @endforeach
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approvals</h2>
            <x-table.table>
                <x-slot name="thead">
                    <x-table.table-header class="text-left" value="Status Done" sort="" />
                    <x-table.table-header class="text-left" value="Approval By" sort="" />
                    <x-table.table-header class="text-left" value="Role" sort="" />
                    <x-table.table-header class="text-left" value="Approval" sort="" />
                    <x-table.table-header class="text-left" value="Note" sort="" />
                    <x-table.table-header class="text-left" value="Date" sort="" />
                </x-slot>
                <x-slot name="tbody">
                @foreach ($custApply->approvals as $item)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            @if($item->order < $custApply->step)
                                <x-heroicon-o-check-circle class="w-6 h-6"/>
                            @elseif($item->order == $custApply->step)
                                <x-heroicon-o-play-circle class="w-6 h-6"/>
                            @endif
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $item->user?->name ?? "-" }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $item->rolegroup?->name }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            @if(str_contains($item->type,'vote')) {{ $item->vote ?? "-" }} @else {{ $item->type ?? "-" }} @endif
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            {{ $item->note ?? "-" }}
                        </x-table.table-body>
                        <x-table.table-body colspan="" class="text-left">
                            @if($item->type == NULL || (str_contains($item->type,'vote') && $item->vote == NULL)) - @else {{ $item->updated_at->format('d-m-Y H:i a') }} @endif
                        </x-table.table-body>
                    </tr>
                @endforeach
                </x-slot>
            </x-table.table>



            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button @click="openModal = false" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
@endisset