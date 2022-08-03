<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Apply Financing > {{ $product->name }}</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-form.basic-form wire:submit.prevent="submit">

            @include('livewire.page.financing.personal')

            @include('livewire.page.financing.extended')

            @include('livewire.page.financing.document')

            @include('livewire.page.financing.checklist')

        </x-form.basic-form>
    </x-general.card>
</div>