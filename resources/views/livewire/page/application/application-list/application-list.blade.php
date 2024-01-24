
<div class="p-4">
    <div wire:loading wire:target="setState">
        <x-loading/>
    </div>
    <h1 class="text-base font-semibold md:text-2xl">List of Approvals</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div x-data="{active : 0}">
            <x-general.card class="flex items-center w-full mb-2 overflow-x-auto bg-white rounded-md ">
                <x-tab.title name="0" livewire="" wire:click="setState('0')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-banknotes class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm text-white border rounded tooltip-text bg-primary-500 border-primary-500 -mt-14">
                            Financing
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="1" livewire="" wire:click="setState('1')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-user-group class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm text-white border rounded tooltip-text bg-primary-500 border-primary-500 -mt-14">
                            Membership
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="2" livewire=""  wire:click="setState('2')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-folder-plus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm text-white border rounded tooltip-text bg-primary-500 border-primary-500 -mt-14">
                            Add Share
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="3" livewire=""  wire:click="setState('3')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-folder-minus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm text-white border rounded tooltip-text bg-primary-500 border-primary-500 -mt-14">
                            Sell Share
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="4" livewire=""  wire:click="setState('4')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-document-plus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Add/Change Contribution
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="5" livewire=""  wire:click="setState('5')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-document-minus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm text-white border rounded tooltip-text bg-primary-500 border-primary-500 -mt-14">
                            Withdrawal Contribution
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="6" livewire=""  wire:click="setState('6')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-newspaper class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm text-white border rounded tooltip-text bg-primary-500 border-primary-500 -mt-14">
                            Special Aid
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="7" livewire=""  wire:click="setState('7')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-arrow-up-on-square-stack class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Dividend Withdrawal
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="8" livewire=""  wire:click="setState('8')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-user-minus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm text-white border rounded tooltip-text bg-primary-500 border-primary-500 -mt-14">
                            Close Membership
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="9" livewire=""  wire:click="setState('9')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-arrows-right-left class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Transfer Share
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="10" livewire=""  wire:click="setState('10')">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-arrows-up-down class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm text-white border rounded tooltip-text bg-primary-500 border-primary-500 -mt-14">
                            Change Guarantor
                        </span>
                    </div>
                </x-tab.title>
            </x-general.card>
            <div x-cloak class="pt-4">
                @switch($setIndex)
                    @case('0')
                        <h2 class="mb-4 text-base font-semibold ">
                            Financing
                        </h2>
                        <livewire:page.application.application-list.financing>
                        @break
                    @case('1')
                        <h2 class="mb-4 text-base font-semibold ">
                            Membership
                        </h2>
                        <livewire:page.application.application-list.membership>
                        @break
                    @case('2')
                        <h2 class="mb-4 text-base font-semibold ">
                            Add Share
                        </h2>
                        <livewire:page.application.application-list.share>
                        @break
                    @case('3')
                        <h2 class="mb-4 text-base font-semibold ">
                            Sell Share
                        </h2>
                        <livewire:page.application.application-list.sell-share>
                        @break
                    @case('4')
                        <h2 class="mb-4 text-base font-semibold ">
                            Add/Change Contribution
                        </h2>
                        <livewire:page.application.application-list.contribution>
                        @break
                    @case('5')
                        <h2 class="mb-4 text-base font-semibold ">
                            Withdrawal Contribution
                        </h2>
                        <livewire:page.application.application-list.withdrawal-contribution>
                        @break
                    @case('6')
                        <h2 class="mb-4 text-base font-semibold ">
                            Special Aid
                        </h2>
                        <livewire:page.application.application-list.special-aid>
                        @break
                    @case('7')
                        <h2 class="mb-4 text-base font-semibold ">
                            Dividend Withdrawal
                        </h2>
                        <livewire:page.application.application-list.dividend>
                        @break
                    @case('8')
                        <h2 class="mb-4 text-base font-semibold ">
                            Close Membership
                        </h2>
                        <livewire:page.application.application-list.close-membership>
                        @break
                    @case('9')
                        <h2 class="mb-4 text-base font-semibold ">
                            Transfer Share
                        </h2>
                        <livewire:page.application.application-list.exchange-share>
                        @break
                    @case('10')
                        <h2 class="mb-4 text-base font-semibold ">
                            Change Guarantor
                        </h2>
                        <livewire:page.application.application-list.change-guarantor>
                        @break
                @endswitch
            </div>
        </div>
    </x-general.card >
</div>
