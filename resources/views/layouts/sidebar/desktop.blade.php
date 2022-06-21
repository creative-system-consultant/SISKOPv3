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
                </ul>
            </div>
        </div>
    </div>
</aside>