<div class="p-4">
    <h1 class="mb-4 text-base font-semibold md:text-2xl">Apply Financing > {{ $Product->name }}</h1>
    <div class="grid grid-cols-1 gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
        <div class="p-4 mt-4 bg-white rounded-md shadow-md">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Application Step </h2>
            <p class="@if ($numpage == 1)  font-bold underline @endif" > Personal / Parent / Spouse / Work Info </p>
            <p class="@if ($numpage == 2)  font-bold underline @endif" > Introducer / Guarantor Info </p>
            <p class="@if ($numpage == 3)  font-bold underline @endif" > Document Info </p>
            <p class="@if ($numpage == 4)  font-bold underline @endif" > Checklist </p>
        </div>
        <div class="p-4 mt-4 bg-white rounded-md shadow-md">
            <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300"> Product Info </h2>
            <p class="text-base font-semibold"> Product Name: {{ $Product->name }}</p>
            <p class="text-base font-semibold"> Profit Rate:  {{ $Product->profit_rate }}%</p>
            <p class="text-base font-semibold"> Minimum Financing Amount: RM {{ $Product->amt_min }}</p>
            <p class="text-base font-semibold"> Maximum Financing Amount: RM {{ $Product->amt_max }}</p>
            <p class="text-base font-semibold"> Minimum Financing Term:  {{ $Product->term_min }} Year</p>
            <p class="text-base font-semibold"> Maximum Financing Term:  {{ $Product->term_max }} Year</p>
        </div>
    </div>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
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