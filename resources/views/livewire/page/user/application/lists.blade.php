<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">List of Application</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div x-data="{active : 0}">
            <x-general.card class="flex items-center w-full mb-2 overflow-x-auto bg-white rounded-md ">
                <x-tab.title name="0" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-archive-box class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        Financing
                    </div>
                </x-tab.title>
                <x-tab.title name="1" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-chart-pie class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        Membership
                    </div>
                </x-tab.title>
                <x-tab.title name="2" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-arrows-right-left class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        Share
                    </div>
                </x-tab.title>
                <x-tab.title name="3" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-document-plus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                            Sell/Exchange Share
                        </div>
                </x-tab.title>
                <x-tab.title name="4" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-document-minus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                            Add Contribution
                        </div>
                </x-tab.title>
                <x-tab.title name="5" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-credit-card class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                            Withdrawal Contribution
                        </div>
                </x-tab.title>
                <x-tab.title name="6" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-identification class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                            Special Aid
                        </div>
                </x-tab.title>
            </x-general.card>
            <div x-cloak class="pt-4">
                <x-tab.content name="0">
                    @include('livewire.page.user.application.financing')
                </x-tab.content>
                <x-tab.content name="1">
                    @include('livewire.page.user.application.membership')
                </x-tab.content>
                <x-tab.content name="2">
                    @include('livewire.page.user.application.share')
                </x-tab.content>
                <x-tab.content name="3">
                    @include('livewire.page.user.application.sell_exchange_share')
                </x-tab.content>
                <x-tab.content name="4">
                    @include('livewire.page.user.application.contribution')
                </x-tab.content>
                <x-tab.content name="5">
                    @include('livewire.page.user.application.withdrawal_contribution')
                </x-tab.content>
                <x-tab.content name="6">
                    @include('livewire.page.user.application.special_aid')
                </x-tab.content>
            </div>
        </div>
    </x-general.card >
</div>
