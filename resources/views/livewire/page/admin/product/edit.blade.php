<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Edit Product</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-form.basic-form wire:submit.prevent="submit('{{ $Product->id }}')" class="p-4">
            <div class="bg-white rounded-md">
                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Product Info </h2>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input
                    label="Product Name"
                    type="text"
                    name="Product.name"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Product.name"
                />
                <x-form.dropdown
                    label="Financing Calculation Type"
                    value=""
                    name="Product.fin_type"
                    id="Product.fin_type"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Product.fin_type"
                >
                @foreach ($loanType as $list)
                    <option value="{{ $list->id }}"> {{ $list->description }} </option>
                @endforeach
                </x-form.dropdown>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.dropdown
                    label="Financing Type"
                    value=""
                    name="Product.product_type"
                    id="Product.product_type"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Product.product_type"
                >
                @foreach ($producttype as $list)
                    <option value="{{ $list->id }}"> {{ $list->description }} </option>
                @endforeach
                </x-form.dropdown>

                <x-form.input-tag
                    label="Profit Rate"
                    type="text"
                    name="Product.profit_rate"
                    value=""
                    leftTag=""
                    rightTag="%"
                    mandatory=""
                    disable=""
                    wire:model="Product.profit_rate"
                />
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.input-tag
                    label="Minimum Financing"
                    type="text"
                    name="Product.amt_min"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    wire:model="Product.amt_min"
                />

                <x-form.input-tag
                    label="Maximum Financing"
                    type="text"
                    name="Product.amt_max"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    wire:model="Product.amt_max"
                />

            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                <x-form.dropdown
                    label="Minimum Financing Term"
                    value=""
                    name="Product.term_min"
                    id=""
                    leftTag=""
                    rightTag="Year"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Product.term_min"
                >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </x-form.dropdown>

                <x-form.dropdown
                    label="Maximum Financing Term"
                    value=""
                    name="Product.term_max"
                    id=""
                    leftTag=""
                    rightTag="Year"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Product.term_max"
                >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </x-form.dropdown>
            </div>
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 mt-4">
                <x-form.dropdown
                    label="Concurrent Product Apply"
                    value=""
                    name="Product.apply_limit"
                    id=""
                    leftTag=""
                    rightTag="Year"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Product.apply_limit"
                >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                </x-form.dropdown>

                <x-form.input
                    label="Lifetime Product Apply (Put 0 for unlimited)"
                    type="text"
                    name="Product.apply_lifetime"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Product.apply_lifetime"
                />
            </div>
            @foreach ($refdocument as $key => $list)
                <div class="mt-4 grid grid-cols-12 gap-6">
                    <div class="col-span-12 sm:col-span-12 md:col-span-4 lg:col-span-1 xl:col-span-1">
                        <div class="flex items-center w-full">
                            <label for="{{ $list->code }}" class="flex items-center cursor-pointer">
                                <div class="relative">
                                    <input
                                        type="checkbox"
                                        id="{{ $list->code }}"
                                        class="sr-only"
                                        @php
                                            $item = $Product->documents()->where('type', $list->code)->first();
                                        @endphp
                                        @if ( $item != NULL)
                                            @if ($item->status == 1)
                                            checked
                                            @else
                                            @endif
                                        @else
                                        @endif
                                        wire:click="enableDoc('{{ $list->code }}','{{ $list->description }}')"
                                    >
                                    <div class="block h-8 bg-gray-300 rounded-full w-14 body"></div>
                                    <div class="absolute w-6 h-6 transition bg-white rounded-full shadow-lg s dot left-1 top-1"></div>
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
                        {{ $list->description }}
                    </div>
                </div>
            @endforeach
            <div class="mt-4 bg-white rounded-md">
                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Brochure </h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                    <x-form.input
                        label="Brochure File (uploaded only: jpg/png/jpeg/pdf)"
                        name="brochure"
                        id="brochure"
                        value=""
                        mandatory=""
                        disable=""
                        type="file"
                        accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                        wire:model="brochure"
                    />
                    <div class="mt-4 mb-8">
                        <div class="flex items-center space-x-4">
                            <img
                            class="w-auto h-32 p-2 rounded-xl ring-2 ring-gray-200 "
                            @if($brochure)
                                src="{{ $brochure->temporaryUrl() }}"
                            @elseif ($brochure_file != NULL)
                                src="{{ asset('storage/'.$brochure_file->filepath) }}"
                            @endif
                            alt="Brochure"
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 bg-white rounded-md">
                <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Payment Table </h2>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                    <x-form.input
                        label="Payment Table File (uploaded only: jpg/png/jpeg/pdf)"
                        name="payment_table"
                        id="payment_table"
                        value=""
                        mandatory=""
                        disable=""
                        type="file"
                        accept=".jpeg, .jpg, .png, .pdf, application/pdf, image/png, image/"
                        wire:model="payment_table"
                    />
                    <div class="mt-4 mb-8">
                        <div class="flex items-center space-x-4">
                            <img
                            class="w-auto h-32 p-2 rounded-xl ring-2 ring-gray-200 "
                            @if($payment_table)
                                src="{{ $payment_table->temporaryUrl() }}"
                            @elseif ($brochure_file != NULL)
                                src="{{ asset('storage/'.$payment_table_file->filepath) }}"
                            @endif
                            alt="Payment Table"
                            >
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-4 flex items-center justify-center space-x-2">
                <a href="{{ route('product.list') }}" class="flex items-center justify-center p-2 text-sm font-semibold text-gray-500 bg-white border-2 rounded-md focus:outline-non">
                    Cancel
                </a>
                <button type="submit" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-green-500 rounded-md focus:outline-none">
                    Update
                </button>
            </div>
        </x-form.basic-form>
    </div>
</div>