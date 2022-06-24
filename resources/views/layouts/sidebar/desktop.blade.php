<!-- Desktop sidebar -->
<x-sidebar-loading/>
<link rel="stylesheet" href="{{ asset('css/sidebar.css')}}" />
<aside
    x-show="isSideMenuOpenDesktop"
    x-transition:enter="transition ease-in-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20"
    @keydown.escape="closeSideMenuDesktop"
    class="z-20 flex-shrink-0 hidden px-2 overflow-y-auto border-r-2 bg-gray-50 md:block" id="sidebar">

    <div class="mb-6 animate" id="nav-items">
        <div class="text-primary">
            <div class="flex justify-center pt-4">
                <x-logo class="w-auto h-8" />
            </div>
            <div class="flex justify-center text-black">
                <p class="text-base italic font-semibold">{{ config('app.name') }}</p>
            </div>
            <div>
                <ul class="mt-6 leading-10">
                    <x-sidebar.nav-item title="HOME" route="{{route('home')}}" uri="home">
                        <x-heroicon-o-home class="w-7 h-7" />
                    </x-sidebar.nav-item>

                    <x-sidebar.nav-item title="Maintenance" route="{{route('list-maintenance')}}" uri="list-maintenance">
                        <x-heroicon-o-cog class="w-7 h-7" />
                    </x-sidebar.nav-item>

                    <x-sidebar.nav-item title="Report" route="{{route('list-reporting')}}" uri="list-reporting">
                        <x-heroicon-o-clipboard-list class="w-7 h-7" />
                    </x-sidebar.nav-item>

                    <x-sidebar.dropdown-nav-item active="open" title="PERMOHONAN" uri="pemohonan/*">
                        <x-slot name="icon">
                            <x-heroicon-o-document-search class="w-7 h-7" />
                        </x-slot>
                        <div class="leading-5">
                            <x-sidebar.dropdown-item title="Menu" href="#" uri="">
                                <x-slot name="icon">
                                    <x-heroicon-o-document-text class="w-7 h-7" />
                                </x-slot>
                            </x-sidebar.dropdown-item>
                        </div>
                    </x-sidebar.dropdown-nav-item>
                    <x-sidebar.nav-item title="SPECIAL AID"  route="{{ route('special_aid.list') }}" uri="SpecialAid/list">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                        </svg>
                    </x-sidebar.nav-item>
                    <x-sidebar.nav-item title="BANK"  route="{{ route('bank') }}" uri="bank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </x-sidebar.nav-item>
                    {{-- <x-sidebar.nav-item title="Special Aid" href="{{ route('special_aid.list') }}" uri="admin/SpecialAid/list">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                    </x-sidebar.nav-item>                --}}
                </ul>
            </div>
        </div>
    </div>
</aside>