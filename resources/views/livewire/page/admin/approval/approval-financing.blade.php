<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Approvals > {{ cameltoString($page) }}</h1>
    @if($page == 'Financing')
    <div class="grid grid-cols-12 gap-6">
        <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-6 xl:col-span-6">
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
        </div>
        @if($rangeview)
        <div class="col-span-12 sm:col-span-12 md:col-span-6 lg:col-span-6 xl:col-span-6">
            <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Select Financing Range</h2>
                <div class="mt-2 grid grid-cols-1 gap-3 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-1 xl:grid-cols-1">
                    @foreach($ranges as $item)
                    @php
                    $first = 'true';
                    $last = 'true';
                    $add = 'false';
                    $rem = 'true';
                    if($loop->first){ $first = 'false'; $rem = 'false'; }
                    if($loop->last){ $last = 'false'; $add = 'true'; }
                    @endphp
                        <x-form.radio-range
                            name="range"
                            label=""
                            value="{{ $loop->index }}"
                            disable=""
                            range1="ranges.{{ $loop->index }}.value1"
                            range2="ranges.{{ $loop->index }}.value2"
                            range1_enable="{{ $first }}" 
                            range2_enable="{{ $last }}"
                            range_add="{{ $add }}"
                            range_addFn="addRanges({{ $loop->index }})"
                            range_rem="{{ $rem }}"
                            range_remFn="remRanges({{ $loop->index }})"
                            wire:model.defer="range"
                            wire:click="setproductrange"
                        />
                    @endforeach
                </div>
            </x-general.card>
        </div>
        @endif
    </div>
    @endif
    @if( $listview )
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Financing {{ $product->name }} </h2>
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
                                    @php $list->role = $list->rolegroup->role->name; @endphp
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
                                                    <h2 class="mb-4 text-lg font-semibold border-b-2 border-gray-300">Approval Settings</h2>
                                                    @if($list->rolegroup->role_id != 1 || $firstMaker)
                                                        <!-- none yet -->
                                                    @else
                                                        @php
                                                            $firstMaker = TRUE;
                                                        @endphp
                                                    @endif
                                                    @if( $list->role == 'MAKER')
                                                        <!-- -->
                                                    @elseif( $list->role == 'CHECKER')
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                                                        <x-form.checkbox
                                                            label="Send To Next"
                                                            id=""
                                                            name=""
                                                            value=""
                                                            disable=""
                                                            wire:model.defer="lists.{{ $key }}.rule_forward"
                                                        />
                                                    </div>
                                                    @elseif( $list->role == 'COMMITTEE' || $list->role == 'APPROVER' )
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                                                        <x-form.dropdown
                                                            label="Vote Type"
                                                            value=""
                                                            name=""
                                                            id=""
                                                            mandatory=""
                                                            disable=""
                                                            default="yes"
                                                            wire:model="rule_vote_type"
                                                        >
                                                            <option value="majority">Majority Vote</option>
                                                            <option value="unanimous">Unanimous Vote</option>
                                                            <option value="absolute_approve">Only 1 Approve needed</option>
                                                            <option value="absolute_decline">Only 1 Decline needed</option>
                                                        </x-form.dropdown>
                                                    </div>
                                                    @endif
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                                                        <x-form.checkbox
                                                            label="Send Whatsapp"
                                                            id=""
                                                            name=""
                                                            value=""
                                                            disable=""
                                                            wire:model.defer="lists.{{ $key }}.rule_whatsapp"
                                                        />
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                                                        <x-form.checkbox
                                                            label="Send SMS"
                                                            id=""
                                                            name=""
                                                            value=""
                                                            disable=""
                                                            wire:model.defer="lists.{{ $key }}.rule_sms"
                                                        />
                                                    </div>
                                                    <div class="grid grid-cols-1 gap-6 mt-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                                                        <x-form.checkbox
                                                            label="Send E-Mail"
                                                            id=""
                                                            name=""
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
