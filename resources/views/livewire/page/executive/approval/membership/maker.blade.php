<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Membership Approval (MAKER)</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div class="pb-4 pl-4 pr-4">
            <div x-data="{active : 1}">
                <div class="flex bg-white rounded-md">
                    <x-tab.title name="0" livewire="">
                        <div class="flex items-center">
                            <x-heroicon-o-document-magnifying-glass class="w-6 h-6 " /> 
                            <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                                Membership Info
                            </span>
                        </div>
                    </x-tab.title>
                    <x-tab.title name="1" livewire="">
                        <div class="flex items-center">
                            <x-heroicon-o-user-circle class="w-6 h-6 " /> 
                            <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                                Applicant Info
                            </span>
                        </div>
                    </x-tab.title>
                    <x-tab.title name="2" livewire="">
                        <div class="flex items-center">
                            <x-heroicon-o-home class="w-6 h-6 " />
                            <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                                Address Info
                            </span>
                        </div>
                    </x-tab.title>
                    <x-tab.title name="3" livewire="">
                        <div class="flex items-center">
                            <x-heroicon-o-user-group class="w-6 h-6 " />
                            <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                                Beneficiary Info
                            </span>
                        </div>
                    </x-tab.title>
                    <x-tab.title name="4" livewire="">
                        <div class="flex items-center">
                            <x-heroicon-o-briefcase class="w-6 h-6 " />
                            <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                                Employment Info
                            </span>
                        </div>
                    </x-tab.title>
                    <x-tab.title name="5" livewire="">
                        <div class="flex items-center">
                            <x-heroicon-o-building-office class="w-6 h-6 " />
                            <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                                Introducer Info
                            </span>
                        </div>
                    </x-tab.title>
                    <x-tab.title name="6" livewire="">
                        <div class="flex items-center">
                            <x-heroicon-o-credit-card class="w-6 h-6 " />
                            <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                                Payment Info
                            </span>
                        </div>
                    </x-tab.title>
                    <x-tab.title name="7" livewire="">
                        <div class="flex items-center">
                            <x-heroicon-o-document-text class="w-6 h-6 " />
                            <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                                Document Info
                            </span>
                        </div>
                    </x-tab.title>
                </div>
                <div class="pt-4 bg-white border-t-2">
                    <x-tab.content name="0">
                        @include('livewire.page.executive.approval.membership.information.client')
                    </x-tab.content>
                    <x-tab.content name="1">
                        @include('livewire.page.executive.approval.membership.information.applicant')
                    </x-tab.content>
                    <x-tab.content name="2">
                        @include('livewire.page.executive.approval.membership.information.address')
                    </x-tab.content>
                    <x-tab.content name="3">
                        @include('livewire.page.executive.approval.membership.information.beneficiary')
                    </x-tab.content>
                    <x-tab.content name="4">
                        @include('livewire.page.executive.approval.membership.information.employment')
                    </x-tab.content>
                    <x-tab.content name="5">
                        @include('livewire.page.executive.approval.membership.information.introducer')
                    </x-tab.content>
                    <x-tab.content name="6">
                        @include('livewire.page.executive.approval.membership.information.payment')
                    </x-tab.content>
                    <x-tab.content name="7">
                        @include('livewire.page.executive.approval.membership.information.document')
                    </x-tab.content>
                </div>
            </div>
        </div>
    </x-general.card>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div x-data="{active : 0}">
            <div class="flex bg-white rounded-md">
                <x-tab.title name="0" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                        <p>Approvals</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="1" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/>
                        <p>Previous Approvals</p>
                    </div>
                </x-tab.title>
            </div>
            <div class="pt-4 bg-white border-t-2">
                <x-tab.content name="0">
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
                                disable="readonly"
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
                </x-tab.content>
                <x-tab.content name="1">
                    <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Previous Approvals</h2>
                    @if($Approval->order > 1)<br>
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="Approval By / Role" sort="" />
                            <x-table.table-header class="text-left" value="Approval" sort="" />
                            <x-table.table-header class="text-left" value="Note" sort="" />
                            <x-table.table-header class="text-left" value="Date" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                        @foreach ($Application->approvals as $item)
                        @if((str_contains($item->type,'vote') && $item->vote == NULL) || $item->type == NULL) @continue @endif
                            <tr>
                                <x-table.table-body colspan="" class="text-left">
                                    {{ $item->user?->name ?? "-" }} <br>
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
                    @else
                    <x-table.table>
                        <x-slot name="thead">
                        </x-slot>
                        <x-slot name="tbody">
                            <tr>
                                <x-table.table-body colspan="" class="text-left">
                                    No Approvals Yet
                                </x-table.table-body>
                            </tr>
                        </x-slot>
                    </x-table.table>
                    @endif
                </x-tab.content>
            </div>
        </div>
        <div class="pb-4 pl-4 pr-4">
            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2">
                    <button type="button" wire:click="decline" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                        Suggest Decline
                    </button>
                    {{--<button type="button" wire:click="deb" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        Debug
                     </button>--}}
                    <button type="button" wire:click="next" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                        Suggest Approve
                    </button>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
