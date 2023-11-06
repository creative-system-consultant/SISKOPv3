<div class="p-4">
    <h1 class="mb-4 text-base font-semibold md:text-2xl">Apply Financing > {{ $Product->name }}</h1>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
        <div class="p-4 mt-4 bg-white dark:bg-gray-700 rounded-md shadow-md">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Financing Information </h2>
            <div class="mt-2 grid grid-cols-1 gap-2 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2">
                <x-form.input
                    label="Product Name"
                    type="text"
                    name="Product.name"
                    value=""
                    mandatory=""
                    disable="true"
                    wire:model="Product.name"
                />
                <x-form.input-tag
                    label="Profit Rate"
                    type="text"
                    name="Product.profit_rate"
                    value=""
                    leftTag=""
                    rightTag="%"
                    mandatory=""
                    disable="true"
                    wire:model="Product.profit_rate"
                />
                <x-form.input-tag
                    label="Amount of Financing Requested"
                    type="text"
                    name="Account.purchase_price"
                    value=""
                    leftTag="RM"
                    rightTag=""
                    mandatory=""
                    disable=""
                    wire:model="Account.purchase_price"
                />
                <x-form.dropdown
                    label="Financing Period Requested"
                    value=""
                    name="Account.duration"
                    id="Account.duration"
                    leftTag=""
                    rightTag="Year"
                    mandatory=""
                    disable=""
                    default="yes"
                    wire:model="Account.duration"
                    >
                    @for ($i = $Product->term_min; $i <= $Product->term_max; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </x-form.dropdown>
            </div>
        </div>
        <div class="p-4 mt-4 bg-white dark:bg-gray-700 rounded-md shadow-md">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Product Info </h2>
            <p class="text-base font-semibold"> Product Name: {{ $Product->name }}</p>
            <p class="text-base font-semibold"> Profit Rate:  {{ $Product->profit_rate }}%</p>
            <p class="text-base font-semibold"> Minimum Financing Amount: RM {{ $Product->amt_min }}</p>
            <p class="text-base font-semibold"> Maximum Financing Amount: RM {{ $Product->amt_max }}</p>
            <p class="text-base font-semibold"> Minimum Financing Term:  {{ $Product->term_min }} Year</p>
            <p class="text-base font-semibold"> Maximum Financing Term:  {{ $Product->term_max }} Year</p>
        </div>
    </div>
    <x-general.card class=" mt-4 py-4 bg-white rounded-md shadow-md relative"  x-data="{ active:0 }" >
        <div class="flex flex-wrap justify-start sm:justify-start bg-white dark:bg-gray-800 shadow-lg rounded-lg mx-4 px-4">
            <x-hovertab.title name="0">
                <x-heroicon-o-chart-pie class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                    Product Info
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="1">
                <x-heroicon-o-user-circle class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                    Personal Detail
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="2">
                <x-heroicon-o-home class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                    Addresses
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="3">
                <x-heroicon-o-user-group class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                    Beneficiary
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="4">
                <x-heroicon-o-briefcase class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                    Employment
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="5">
                <x-heroicon-o-clipboard-document-list class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                    Guarantor
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="6">
                <x-heroicon-o-clipboard-document class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                    Referrer
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="7">
                <x-heroicon-o-credit-card class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                    Payment
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="8">
                <x-heroicon-o-arrow-up-tray class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                    Upload Document
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="9">
                <x-heroicon-o-document-text class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                    Review Document
                </span>
            </x-hovertab.title>
        </div>

        <x-form.basic-form wire:submit.prevent="alertConfirm">
            
            @include('livewire.page.application.apply-financing.personal')

            @include('livewire.page.application.apply-financing.extended')

            @include('livewire.page.application.apply-financing.document')

            @include('livewire.page.application.apply-financing.checklist')
        </x-form.basic-form>
    </x-general.card>
</div>

@push('js')
<script>
    window.addEventListener('swal:confirm', event => {
        swal.fire({
            icon: event.detail.type,
            title: event.detail.title,
            html: event.detail.html,
            footer: event.detail.note,
            confirmButtonText: 'Submit',
            showCancelButton: true,
            cancelButtonText: 'Cancel',
        }).then(function(result){
            if(result.isConfirmed){
                window.Livewire.emit('submit');
            }
        });
    });
</script>
@endpush