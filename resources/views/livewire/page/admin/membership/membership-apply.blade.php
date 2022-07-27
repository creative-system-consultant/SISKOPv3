<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Membership Registration</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <x-form.basic-form wire:submit.prevent="submit" class="p-4">
            @include('livewire.page.admin.membership.basicinfo')
            @include('livewire.page.admin.membership.extendedinfo')
        </x-form.basic-form>
    </div>
</div>



