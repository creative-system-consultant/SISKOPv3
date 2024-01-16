@isset($Change)
<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information - {{ $Change->id }}</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <x-form.input
                    label="Name"
                    name="custname"
                    value="{{ $Change->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />

                <x-form.input
                    label="Identity Number"
                    name="custic"
                    value="{{ $Change->customer->icno ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>

            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Change Guarantor Information</h2>
            <div class="mt-2">
                <x-table.table>
                    <x-slot name="thead">
                        <tr  class="">
                            <th  colspan="3" class="px-6 py-3 border  text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center bg-primary-50" >
                                Old Guarantor 
                            </th>
                            <th  colspan="3" class="px-6 py-3 border text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-center bg-primary-100" >
                                New Guarantor
                            </th>
                        </tr>
                        <tr>
                            <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                                No
                            </th>
                            <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                                Name
                            </th>
                            <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                                NRIC
                            </th>
                            <th  colspan="1" class="px-6 py-3 border bg-gray-50 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                                No
                            </th>
                            <th  colspan="1" class="px-6 py-3 border bg-gray-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                                Name
                            </th>
                            <th  colspan="1" class="px-6 py-3 border bg-gray-100 text-xs leading-4 font-medium uppercase tracking-wider dark:bg-gray-600 dark:text-white text-left" >
                                NRIC
                            </th>
                        </tr>
                        
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse($ChangeGuarantorsDetails as $item)
                            <tr>
                                <td  width="5%" class="px-6  py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                                    {{$loop->iteration}}
                                </td>
                                <td  width="30%" class="px-6  py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                                    {{$item->old_jamin_name}}
                                </td>
                                <td  width="15%" class="px-6  py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                                    {{$item->old_jamin_icno}}
                                </td>

                                <td  width="5%" class="px-6  py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                                    {{$loop->iteration}}
                                </td>

                                <td  width="35%" class="px-6  py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                                    {{$item->new_jamin_name}}
                                </td>
                                <td  width="15%" class="px-6 py-2 whitespace-no-wrap leading-5 bg-white dark:bg-gray-700 dark:text-white border text-left text-xs">
                                    {{$item->new_jamin_icno}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <x-table.table-body colspan="6" class="text-center">
                                    No Data
                                </x-table.table-body>
                            </tr>
                        @endforelse
                    </x-slot>
                </x-table.table>
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
                @foreach ($Change->approvals as $item)
                    <tr>
                        <x-table.table-body colspan="" class="text-left">
                            @if($item->order < $Change->step || $Change->flag > 1)
                                <x-heroicon-o-check-circle class="w-6 h-6 text-green-500"/>
                            @elseif($item->order == $Change->step)
                                <x-heroicon-o-play-circle class="w-6 h-6 text-blue-500"/>
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
                @if($Change?->flag == 1)
                    <button wire:click="remake_approvals" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 border-2 rounded-md focus:outline-non">
                        RESET APPROVALS
                    </button>
                @endif
                    <button @click="openModal = false" wire:click="clearApplication" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
@endisset