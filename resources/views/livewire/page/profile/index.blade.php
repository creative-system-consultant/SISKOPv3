<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Profile</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md" x-data="{active : 0}" >
        <div class="flex w-full mb-2 overflow-x-auto border-b-2 flex-nowrap">
            <x-tab.title name="0" livewire="">
                <div class="flex items-center w-40 md:w-full">
                    <x-heroicon-o-user-circle class="w-6 h-6 mr-2"/> 
                    <p>Profile Information</p>
                </div>
            </x-tab.title>
            <x-tab.title name="1" livewire="">
                <div class="flex items-center w-52 md:w-full">
                    <x-heroicon-o-cog class="w-6 h-6 mr-2"/> 
                    <p>Account Settings</p>
                </div>
            </x-tab.title>
        </div>
        <div class="pt-4 bg-white ">

            <x-tab.content name="0">
                <livewire:page.profile.profile />
            </x-tab.content>
            <x-tab.content name="1">
                <livewire:page.profile.account-setting />
            </x-tab.content>
        </div>
    </div>
</div>