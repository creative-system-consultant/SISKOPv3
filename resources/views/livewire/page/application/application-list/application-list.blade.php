@extends('layouts.head')
@section('content')
<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">List of Approvals</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div x-data="{active : @if(isset(request()->page)){{ request()->page }} @else 0 @endif}">
            <x-general.card class="flex items-center w-full mb-2 overflow-x-auto bg-white rounded-md ">
                <x-tab.title name="0" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-banknotes class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Financing
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="1" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-user-group class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Membership
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="2" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-folder-plus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Add Share
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="3" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-folder-minus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Sell Share
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="9" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-arrows-right-left class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Exchange Share
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="4" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-document-plus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Add Contribution
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="5" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-document-minus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Withdrawal Contribution
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="6" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-newspaper class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Special Aid
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="7" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-arrow-up-on-square-stack class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Dividend Payout
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="8" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-user-minus class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Close Membership
                        </span>
                    </div>
                </x-tab.title>
                <x-tab.title name="10" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-arrows-up-down class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        <span class="text-sm tooltip-text bg-primary-500 border rounded border-primary-500 text-white -mt-14">
                            Change Guarantor
                        </span>
                    </div>
                </x-tab.title>
            </x-general.card>
            <div x-cloak class="pt-4">
                <x-tab.content name="0">
                    <livewire:page.application.application-list.financing>
                </x-tab.content>
                <x-tab.content name="1">
                    <livewire:page.application.application-list.membership>
                </x-tab.content>
                <x-tab.content name="2">
                    <livewire:page.application.application-list.share>
                </x-tab.content>
                <x-tab.content name="3">
                    <livewire:page.application.application-list.sell-share>
                </x-tab.content>
                <x-tab.content name="4">
                    <livewire:page.application.application-list.contribution>
                </x-tab.content>
                <x-tab.content name="5">
                    <livewire:page.application.application-list.withdrawal-contribution>
                </x-tab.content>
                <x-tab.content name="6">
                    <livewire:page.application.application-list.special-aid>
                </x-tab.content>
                <x-tab.content name="7">
                    <livewire:page.application.application-list.dividend>
                </x-tab.content>
                <x-tab.content name="8">
                    <livewire:page.application.application-list.close-membership>
                </x-tab.content>
                <x-tab.content name="9">
                    <livewire:page.application.application-list.exchange-share>
                </x-tab.content>
                <x-tab.content name="10">
                    <livewire:page.application.application-list.change-guarantor>
                </x-tab.content>
            </div>
        </div>
    </x-general.card >
</div>
@endsection
