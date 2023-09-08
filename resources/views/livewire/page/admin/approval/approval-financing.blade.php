<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Approvals > {{ cameltoString($page) }}</h1>
    @if($page == 'Financing')
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Select Product</h2>
        <div class="mt-2 grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
            @forelse ($products as $item)
                <x-form.radio
                    label="{{ $item->name }}"
                    value="{{ $item->id }}"
                    disable=""
                    wire:model.defer="product.id"
                    wire:click="setproduct"
                />
            @empty
                no products
            @endforelse
        </div>
    </x-general.card>
    @endif
    @if(($page == 'Financing' && $product != NULL) || $page != 'Financing')
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-form.basic-form wire:submit.prevent="submit" class="p-4">
            <div class="grid grid-cols-12 gap-6 mt-6">
                <div class="col-span-12 sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12">
                    <x-table.table>
                        <x-slot name="thead">
                            <x-table.table-header class="text-left" value="Order" sort="" />
                            <x-table.table-header class="text-left" value="Group" sort="" />
                            <x-table.table-header class="text-left" value="Role" sort="" />
                            <x-table.table-header class="text-left" value="Action" sort="" />
                        </x-slot>
                        <x-slot name="tbody">
                        @forelse ($lists as $key => $list)
                            <tr>
                                <x-table.table-body colspan="" class="text-left">
                                    {{ $loop->iteration }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                    {{ $list->rolegroup->name }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                    {{ $list->rolegroup->role->name }}
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="text-left">
                                    <div class="flex items-center">
                                        <button type="button" wire:click="rem({{ $list->id }})" class="flex items-center justify-center p-2 mx-1 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                                            <x-heroicon-o-trash class="w-7 h-7 text-white-800" />
                                        </button>
                                        <button type="button" @if($loop->first) @else wire:click="up({{ $list->order }})" @endif class="flex items-center justify-center p-2 mx-1 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                                            @if($loop->first)
                                            <x-heroicon-o-minus-small class="w-7 h-7 text-white-800" />
                                            @else
                                            <x-heroicon-o-arrow-up-circle class="w-7 h-7 text-white-800" />
                                            @endif
                                        </button>
                                        <button type="button" @if($loop->last) @else wire:click="down({{ $list->order }})" @endif class="flex items-center justify-center p-2 mx-1 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                                            @if($loop->last)
                                            <x-heroicon-o-minus-small class="w-7 h-7 text-white-800" />
                                            @else
                                            <x-heroicon-o-arrow-down-circle class="w-7 h-7 text-white-800" />
                                            @endif
                                        </button>
                                        <div x-data="{ruleModal:false}">
                                            <button type="button" @click="ruleModal = true" wire:click="change_rule({{ $list->order }})" class="flex items-center justify-center p-2 mx-1 text-sm font-semibold text-white bg-orange-500 rounded-md focus:outline-none">
                                                <x-heroicon-o-book-open class="w-7 h-7 text-white-800" />
                                            </button>
                                            <x-modal.modal
                                                modalActive="ruleModal"
                                                title="Group Rule"
                                                modalSize="xl"
                                                closeBtn="yes"
                                            >
                                                <div class="p-4">
                                                    <h2 class="mb-4 text-lg font-semibold border-b-2 border-gray-300">Approval Value</h2>
                                                    @if($list->rolegroup->role_id != 1 || $firstMaker)
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                                                        <x-form.input-tag
                                                            label="Min Financing"
                                                            name=""
                                                            id=""
                                                            value=""
                                                            leftTag="RM"
                                                            rightTag=""
                                                            mandatory=""
                                                            disable=""
                                                            type="text"
                                                            wire:model.defer="lists.{{ $key }}.rule_min"
                                                        />
                                                        <x-form.input-tag
                                                            label="Max Financing"
                                                            name=""
                                                            id=""
                                                            value=""
                                                            leftTag="RM"
                                                            rightTag=""
                                                            mandatory=""
                                                            disable=""
                                                            type="text"
                                                            wire:model.defer="lists.{{ $key }}.rule_max"
                                                        />
                                                    </div>
                                                    @else
                                                        @php
                                                            $firstMaker = TRUE;
                                                            $list->rule_min = 0;
                                                            $list->rule_max = 0;
                                                            $list->save();
                                                        @endphp
                                                    @endif
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                                                        <x-form.input-tag
                                                            label="Employer"
                                                            name=""
                                                            id=""
                                                            value=""
                                                            leftTag=""
                                                            rightTag=""
                                                            mandatory=""
                                                            disable=""
                                                            type="text"
                                                            wire:model.defer="lists.{{ $key }}.rule_employee"
                                                        />
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                                                        <x-form.checkbox
                                                            label="Send Whatsapp"
                                                            id="sendWs"
                                                            name="sendWs"
                                                            value=""
                                                            disable=""
                                                            wire:model.defer="lists.{{ $key }}.rule_whatsapp"
                                                        />
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                                                        <x-form.checkbox
                                                            label="Send SMS"
                                                            id="sendSms"
                                                            name="sendSms"
                                                            value=""
                                                            disable=""
                                                            wire:model.defer="lists.{{ $key }}.rule_sms"
                                                        />
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                                                        <x-form.checkbox
                                                            label="Send E-mail"
                                                            id="sendEmail"
                                                            name="sendEmail"
                                                            value=""
                                                            disable=""
                                                            wire:model.defer="lists.{{ $key }}.rule_email"
                                                        />
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                                                        <button @click="ruleModal = false" wire:click="saveRule({{ $key }})" type="button" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                                                            Save and Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </x-modal.modal>
                                        </div>
                                    </div>
                                </x-table.table-body>
                            </tr>
                        @empty
                            <tr>
                                <x-table.table-body colspan="3" class="text-left">
                                    NO GROUP ADDED
                                </x-table.table-body>
                            </tr>
                        @endforelse
                            <tr>
                                <x-table.table-body colspan="2" class="bg-gray-50 text-left">
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="bg-gray-50 text-left">
                                    <x-form.dropdown
                                        label=""
                                        value=""
                                        name="selected"
                                        id=""
                                        mandatory=""
                                        disable=""
                                        default="yes"
                                        wire:model.defer="selected"
                                    >
                                    @forelse ($coopGroup as $list)
                                        <option value="{{ $list->id }}">{{ $list->name }} - {{ $list->role->name }}</option>
                                    @empty
                                    {{-- if empty --}}
                                    @endforelse
                                    </x-form.dropdown>
                                </x-table.table-body>
                                <x-table.table-body colspan="" class="bg-gray-50 text-left">
                                    <button type="button" wire:click="add" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                                        ADD
                                    </button>
                                </x-table.table-body>
                            </tr>
                        </x-slot>
                    </x-table.table>
                </div>
            </div>
            <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                <div class="flex items-center justify-center space-x-2 mb-4">
                    <p>All changes are saved automatically</p>
                </div>
                <div class="flex items-center justify-center space-x-2">
                    <a href="{{ url()->previous() }}" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 border-2 rounded-md focus:outline-non">
                        Back
                    </a>
                    <button type="button" wire:click="deb" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-blue-500 rounded-md focus:outline-none">
                        debug
                    </button>
                </div>
            </div>
            <div wire:loading>
                <x-main-loading />
            </div>
        </x-form.basic-form>
    </x-general.card>
    @endif
</div>
