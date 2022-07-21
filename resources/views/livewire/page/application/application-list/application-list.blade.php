@extends('layouts.head')
@section('content')
<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">List of Application</h1>
    <div class="p-4 mt-4 bg-white rounded-md shadow-md">
        <div x-data="{active : 0}">
            <div class="flex bg-white rounded-md">
                <x-tab.title name="0" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-archive class="w-6 h-6 mr-2"/> 
                        <p>Special Aid</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="1" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-chart-pie class="w-6 h-6 mr-2"/> 
                        <p>Share</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="2" livewire="">
                <div class="flex items-center">
                    <x-heroicon-o-switch-horizontal class="w-6 h-6 mr-2"/> 
                        <p>Sell/Exchange Share</p>
                    </div>
                </x-tab.title>
                <x-tab.title name="3" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-document-add class="w-6 h-6 mr-2"/> 
                            <p>Add Contribution</p>
                        </div>
                </x-tab.title>
                <x-tab.title name="4" livewire="">
                    <div class="flex items-center">
                        <x-heroicon-o-document-remove class="w-6 h-6 mr-2"/> 
                            <p>Withdrawal Contribution</p>
                        </div>
                </x-tab.title>
            </div>
            <div x-cloak class="pt-4 bg-white border-t-2">
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
            </div>
        </div>                        
    </div>
</div>
@endsection