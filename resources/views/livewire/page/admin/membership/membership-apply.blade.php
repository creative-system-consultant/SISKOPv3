<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Membership Registration</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <h2 class="mb-4 text-base font-semibold border-b-2 border-gray-300">Application Step</h2>
        <p class="@if ($numpage == 1) text-blue-600 font-bold underline @endif">Personal / Parent / Spouse / Work Info</p>
        <p class="@if ($numpage == 2) text-blue-600 font-bold underline @endif">Introducer Info</p>
        <p class="@if ($numpage == 3) text-blue-600 font-bold underline @endif">Payment Info</p>
        <p class="@if ($numpage == 4) text-blue-600 font-bold underline @endif">Document Info</p>
        <p class="@if ($numpage == 5) text-blue-600 font-bold underline @endif">Checklist</p>
    </div>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        {{-- <x-form.basic-form wire:submit.prevent="submit" class="p-4"> --}}
        <x-form.basic-form wire:submit.prevent="alertConfirm">
            @include('livewire.page.admin.membership.basicinfo')
            @include('livewire.page.admin.membership.extendedinfo')
            @include('livewire.page.admin.membership.paymentinfo')
            @include('livewire.page.admin.membership.documentinfo')
            @include('livewire.page.admin.membership.checklistinfo')
        </x-form.basic-form>
    </div>
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



