@extends('layouts.head')
@section('content')
<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">List of Application</h1>
    <x-general.card class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div x-data="{active : 0}">
            <x-general.card class="flex items-center w-full mb-2 overflow-x-auto bg-white rounded-md ">
                <x-tab.title name="0" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-archive class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/>
                        Special Aid
                    </div>
                </x-tab.title>
                <x-tab.title name="1" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-chart-pie class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/> 
                        Share
                    </div>
                </x-tab.title>
                <x-tab.title name="2" livewire="">
                <div class="flex flex-col items-center lg:flex-row">
                    <x-heroicon-o-switch-horizontal class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/> 
                        Sell/Exchange Share
                    </div>
                </x-tab.title>
                <x-tab.title name="3" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-document-add class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/> 
                            Add Contribution
                        </div>
                </x-tab.title>
                <x-tab.title name="4" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-document-remove class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/> 
                            Withdrawal Contribution
                        </div>
                </x-tab.title>
                <x-tab.title name="5" livewire="">
                    <div class="flex flex-col items-center lg:flex-row">
                        <x-heroicon-o-identification class="w-6 h-6 mb-2 mr-0 lg:mr-2 lg:mb-0"/> 
                            Membership
                        </div>
                </x-tab.title>
            </x-general.card>
            <div x-cloak class="pt-4">
                <x-tab.content name="0">
                    <livewire:page.application.application-list.special-aid>
                </x-tab.content>
                <x-tab.content name="1">
                    <livewire:page.application.application-list.share>
                </x-tab.content>
                <x-tab.content name="2">
                    <livewire:page.application.application-list.sell_-exchange-share>                  
                </x-tab.content>
                <x-tab.content name="3">
                    <livewire:page.application.application-list.contribution>
                </x-tab.content>
                <x-tab.content name="4">
                    <livewire:page.application.application-list.withdrawal_-contribution>
                </x-tab.content>
                <x-tab.content name="5">
                    <livewire:page.application.application-list.membership>
                </x-tab.content>
            </div>
        </div>                        
    </x-general.card >
</div>
@endsection