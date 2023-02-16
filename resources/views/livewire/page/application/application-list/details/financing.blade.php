@isset($financing)
<div>
    <x-general.card class="px-4">
        <div class="pb-4 pl-4 pr-4">
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Financing Information</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                    <x-form.input
                        label="Product Name"
                        type="text"
                        name="cont_apply"
                        value="{{ $financing->product->name ?? '' }}"
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input-tag
                        label="Amount requested"
                        type="text"
                        name="cont_approved"
                        value="{{ $financing->purchase_price ?? '0.00' }}"
                        placeholder="0.00"
                        leftTag="RM"
                        rightTag=""
                        mandatory=""
                        disable="true"
                    />
                    <x-form.input
                        label="Term requested"
                        type="text"
                        name="cont_approved"
                        value="{{ $financing->duration ?? '' }} Year"
                        mandatory=""
                        disable="true"
                    />
                </div>
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Applicant Information</h2>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Name"
                    name=""
                    value="{{ $financing->customer->name ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Identity Number"
                    name=""
                    value="{{ $financing->customer->icno ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Birthdate"
                    type="date"
                    name=""
                    value="{{ $financing->customer->birthdate ?? '' }}"
                    mandatory=""
                    disable="true"
                />
                <x-form.input
                    label="Mobile Number"
                    type="text"
                    name=""
                    value="{{ $financing->customer->mobile_num ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                {{-- Address..... --}}
                <x-form.input
                    label="Email"
                    type="text"
                    name=""
                    value="{{ $financing->customer->email ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                {{--
                <x-form.input
                    label="Membership Number"
                    type="text"
                    name=""
                    value="{{ $financing->customer->mbr_no ?? '' }}"
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.dropdown
                        label="Gender"
                        value=""
                        name="gender_code"
                        id="gender_code"
                        mandatory=""
                        disable="true"
                        default="yes"
                        >
                        @foreach ($genderName ?? [] as $list)
                            <option @if ($list->code == $financing->gender_code) selected @endif>{{ $list->description }}</option>
                        @endforeach
                    </x-form.dropdown>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Race"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Education"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Marital"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Title"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                --}}
            </div>
            {{--
            <h1 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Family Information</h1>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Relationship"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Name"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="IC Number"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Mobile Number"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                Address.....
            </div>
            --}}
            {{--
            <h1 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Company Information</h1>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Company Name"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Name Of Department"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Position"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Office Telephone Number"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                <x-form.input
                    label="Salary"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />
                <x-form.input
                    label="Worker Number"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable="true"
                    type="text"
                />

                Address.....
            </div>
            --}}
            {{--
            <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Introducer Information</h2>
            <div>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                    <x-form.input
                        label="Introducer Name"
                        name=""
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input
                        label="Introducer IC Number"
                        name=""
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input
                        label="Introducer Email"
                        name=""
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input
                        label="Introducer Membership Number"
                        name=""
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>

                <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Guarantor Information</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                    <x-form.input
                        label="Guarantor Name"
                        name=""
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input
                        label="Guarantor IC Number"
                        name=""
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input
                        label="Guarantor Email"
                        name=""
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                    <x-form.input
                        label="Guarantor Membership Number"
                        name=""
                        value=""
                        mandatory=""
                        disable="true"
                        type="text"
                    />
                </div>
                --}}
                {{--
                <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Upload Document</h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                    @forelse ($financing->files as $supportDoc)
                        <a href="{{ asset('storage/'.$supportDoc->filepath) }}" target="_blank" class="inline-flex items-center px-4 py-2 text-sm font-bold text-white bg-blue-500 rounded-md hover:bg-blue-400">
                            <x-heroicon-o-document class="w-5 h-5 mr-2"/>
                            Show
                        </a>
                    @empty
                        <h2 class="mb-4 ml-4 text-base border-gray-300">No Document</h2>
                    @endforelse
                </div>
                --}}
                <h2 class="mt-6 mb-4 text-lg font-semibold border-b-2 border-gray-300">Approvals</h2>
                <x-table.table>
                    <x-slot name="thead">
                        <x-table.table-header class="text-left" value="Approval By / Role" sort="" />
                        <x-table.table-header class="text-left" value="Approval" sort="" />
                        <x-table.table-header class="text-left" value="Note" sort="" />
                        <x-table.table-header class="text-left" value="Date" sort="" />
                    </x-slot>
                    <x-slot name="tbody">
                    @foreach ($financing->approvals as $item)
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
                <div class="p-4 mt-6 rounded-md bg-gray-50 dark:bg-gray-600">
                    <div class="flex items-center justify-center space-x-2">
                        <button @click="openModal = false" wire:click="closeApplication" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 border-2 rounded-md focus:outline-non">
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </x-general.card>
</div>
@endisset