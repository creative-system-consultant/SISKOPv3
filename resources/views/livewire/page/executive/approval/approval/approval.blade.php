<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">{{ $pagename }} Approval</h1>

    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div x-data="{active : 1}">
            <div class="flex bg-white border-b rounded-md">
                <x-tab.title name="1" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-user-circle class="w-6 h-6 " />
                        <span class="text-sm text-white border rounded tooltip-text bg-primary-500 border-primary-500 -mt-14">
                            Applicant Info
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="2" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-document-text class="w-6 h-6 " /> 
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14 capitalize">
                            {{ $pagename }} Info
                        </span>
                    </div>
                </x-tab.title>
            </div>
            <div class="pb-4 pl-4 pr-4">
                <x-tab.content name="1">
                    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
                    <div class="mb-3 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                        <x-form.input
                            label="Name"
                            name="custname"
                            value="{{ $Application->customer->name ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                        <x-form.input
                            label="Identity Number"
                            name="custic"
                            value="{{ $Application->customer->icno ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                        <x-form.input
                            label="Member Number"
                            name="mbrno"
                            value="{{ $Application->customer->mbr_no ?? '' }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                    </div>
                    <div class="mb-3 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                        <x-form.input
                            label="Bank"
                            name=""
                            value="{{ $Application->customer->bank?->description }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                        <x-form.input
                            label="Account Bank No."
                            name=""
                            value="{{ $Application->customer->bank_acct_no }}"
                            mandatory=""
                            disable="true"
                            type="text"
                        />
                    </div>
                </x-tab.content>
                <x-tab.content name="2">
                    @include('livewire.page.executive.approval.approval.'.$include)
                </x-tab.content>
                {{-- @include('livewire.page.executive.approval.approval.contribution') --}}
                {{-- @include('livewire.page.executive.approval.approval.sellcontribution') --}}
                {{-- @include('livewire.page.executive.approval.approval.dividend') --}}
                {{-- @include('livewire.page.executive.approval.approval.share') --}}
                {{-- @include('livewire.page.executive.approval.approval.sellshare') --}}
                {{-- @include('livewire.page.executive.approval.approval.exchangeshare') --}}
                {{-- @include('livewire.page.executive.approval.approval.closemembership') --}}
                {{-- @include('livewire.page.executive.approval.approval.specialaid') --}}
            </div>
        </div>
    </x-general.card>

    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div x-data="{active : 1}">
            <div class="flex bg-white rounded-md">
                <x-tab.title name="1" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                        <p>Approvals</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="2" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                        <p>Previous Approvals</p>
                    </div>
                </x-tab.title>
            </div>

            <x-tab.content name="1">
                <div class="mt-6">
                    @if($Approval->order == 1) No Approvals Yet @endif
                    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approval</h2>
                    <div class="grid grid-cols-12 gap-6 mt-8">
                        <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                            <x-form.text-area
                                label="Note / Comment : ({{ strlen($Approval->note) }}/255)"
                                value=""
                                name="Approval.note"
                                rows=""
                                disable=""
                                mandatory=""
                                placeholder=""
                                wire:model="Approval.note"
                            />
                            <x-form.input
                                label="Check By"
                                name="precheck_by"
                                value="{{ $User->name }}"
                                mandatory=""
                                disable="true"
                                type="text"
                            />
                            <x-form.input
                                label=""
                                name="Role"
                                value="{{ $Application->current_approval_role()->name }}"
                                mandatory=""
                                disable="readonly"
                                type="text"
                            />
                        </div>
                    </div>
                </div>
            </x-tab.content>

            <x-tab.content name="2">
                <div>
                    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Previous Approvals</h2>
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="Approval By" sort="" />
                            <x-table.table-header class="text-left" value="Role" sort="" />
                            <x-table.table-header class="text-left" value="Approval" sort="" />
                            <x-table.table-header class="text-left" value="Note" sort="" />
                            <x-table.table-header class="text-left" value="Date" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                        @foreach ($Application->approvals as $item)
                        @if((str_contains($item->type,'vote') && $item->vote == NULL) || $item->type == NULL) @continue @endif
                            <tr>
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
                                    @if($item->type == NULL || (str_contains($item->type,'vote') && $item->vote == NULL)) - @else {{ $item->updated_at }} @endif
                                </x-table.table-body>
                            </tr>
                        @endforeach
                        </x-slot>
                    </x-table.table>
                </div>
            </x-tab.content>

            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button type="button" wire:click="decline" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                        {{ $vote }} Decline
                    </button>
                    <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        {{ $vote }} Approve
                    </button>
                    @if($forward)
                        <button wire:click="forward" type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-orange-500 rounded-md focus:outline-none">
                        Send To Next Approval
                        </button>
                    @endif
                </div>
            </div>

        </div>
    </x-general.card>
</div>
