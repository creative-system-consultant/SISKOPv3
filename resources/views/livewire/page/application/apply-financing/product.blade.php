
    <!-- product Info -->
    <div x-show="active == 0">
        <div class="px-6 py-4 mt-4">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Product Info </h2>
            <div class="mt-2 grid grid-cols-1 gap-2 md:grid-cols-2 lg:grid-cols-4">
                <x-form.input
                    label="Product Name"
                    type="text"
                    name="Product.name"
                    value=""
                    mandatory=""
                    disable=""
                    wire:model="Product.name"
                />
                <x-form.input
                    label="Apply Amount"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    wire:model=""
                />
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
                <x-form.dropdown
                    label="Period (Month)"
                    value=""
                    name=""
                    id=""
                    leftTag=""
                    rightTag=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                    >
                    <option value=""></option>
                </x-form.dropdown>
                <x-form.dropdown
                    label="Panel / Brand"
                    value=""
                    name=""
                    id=""
                    leftTag=""
                    rightTag=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                    >
                    <option value=""></option>
                </x-form.dropdown>
                <x-form.dropdown
                    label="Goods Type"
                    value=""
                    name=""
                    id=""
                    leftTag=""
                    rightTag=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                    >
                    <option value=""></option>
                </x-form.dropdown>
                <x-form.dropdown
                    label="Financing Type"
                    value=""
                    name=""
                    id=""
                    leftTag=""
                    rightTag=""
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model=""
                    >
                    <option value=""></option>
                </x-form.dropdown>
                <x-form.input
                    label="Purpose (Please state your purpose)"
                    type="text"
                    name=""
                    value=""
                    mandatory=""
                    disable=""
                    wire:model=""
                />
                <x-form.input-tag
                    label="Expected Monthly Instalment"
                    type="text"
                    name=""
                    value=""
                    leftTag=""
                    rightTag="%"
                    mandatory=""
                    disable=""
                    wire:model=""
                />
            </div>
        </div>
    </div>
