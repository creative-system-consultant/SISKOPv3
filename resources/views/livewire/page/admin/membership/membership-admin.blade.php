<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Membership Application Maintenance</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div x-data="{active : 0}">
            <div class="flex bg-white rounded-md">
                <x-tab.title name="0" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/> 
                        <p>Basic Info</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="1" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/> 
                        <p>Document Info</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="2" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-credit-card class="w-6 h-6 mr-2"/> 
                        <p>Payment Info</p>
                    </div>
                </x-tab.title>
            </div>
            <div class="pt-4 bg-white border-t-2">
                <x-tab.content name="0">
                    @include('livewire.page.admin.membership.tab-admin.tab1-admin')
                </x-tab.content>
                <x-tab.content name="1">
                    @include('livewire.page.admin.membership.tab-admin.tab2-admin')
                </x-tab.content>
                <x-tab.content name="2">
                    @include('livewire.page.admin.membership.tab-admin.tab3-admin')
                </x-tab.content>
            </div>
        </div>
    </div>
</div>
       
