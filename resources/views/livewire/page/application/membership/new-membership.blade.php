<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Membership Registration</h1>

    <x-general.card class=" mt-4 py-4  rounded-md shadow-md relative"  x-data="{ active:0 }"
    @tab-changed.window="active = $event.detail.newActiveTab" 
    @increment-tab.window="active++" 
    @decrement-tab.window="if(active > 0) active--">
        <div class="flex flex-wrap justify-start sm:justify-start bg-white dark:bg-gray-800 shadow-lg rounded-lg mx-4 px-4">
            {{-- <p>Active Tab: <span x-text="active"></span></p> --}}
            <x-hovertab.title name="0" varble="{{$tab1}}" wire:click="nextTab({{$numpage}},1,1)">
                <x-heroicon-o-user-circle class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                    Personal Detail
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="1" varble="{{$tab2}}" wire:click="nextTab({{$numpage}},2,1)">
                <x-heroicon-o-home class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                    Addresses
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="2" varble="{{$tab3}}" wire:click="nextTab({{$numpage}},3,1)">
                <x-heroicon-o-user-group class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-400 border rounded border-primary-500 text-white -mt-14">
                    Beneficiary
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="3" varble="{{$tab4}}" wire:click="nextTab({{$numpage}},4,1)">
                <x-heroicon-o-briefcase class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                    Employment
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="4" varble="{{$tab5}}" wire:click="nextTab({{$numpage}},5,1)">
                <x-heroicon-o-building-office class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                    Introducer
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="5" varble="{{$tab6}}" wire:click="nextTab({{$numpage}},6,1)">
                <x-heroicon-o-credit-card class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                    Deduction & Payment
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="6" varble="{{$tab7}}" wire:click="nextTab({{$numpage}},7,1)">
                <x-heroicon-o-arrow-up-tray class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                    Upload Document
                </span>
            </x-hovertab.title>
            <x-hovertab.title name="7" varble="{{$tab8}}" wire:click="nextTab({{$numpage}},8,1)">
                <x-heroicon-o-document-text class="w-6 h-6 " />
                <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                    Checklist
                </span>
            </x-hovertab.title>
        </div>

        <x-form.basic-form wire:submit.prevent="alertConfirm">
            @include('livewire.page.application.membership.basicinfo')
            @include('livewire.page.application.membership.extendedinfo')
            @include('livewire.page.application.membership.paymentinfo')
            @include('livewire.page.application.membership.documentinfo')
            @include('livewire.page.application.membership.checklistinfo')
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



