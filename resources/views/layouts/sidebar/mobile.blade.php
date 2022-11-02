    <!-- Mobile sidebar -->
    <!-- Backdrop -->
    <div
        x-cloak
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-10 flex items-end bg-gray-800 bg-opacity-50 sm:items-center sm:justify-center"
        @click="closeSideMenu"
    ></div>

    <aside
        x-cloak
        class="fixed inset-y-0 z-20 flex-shrink-0 w-64 overflow-y-auto bg-white md:hidden dark:bg-gray-800"
        x-show="isSideMenuOpen"
        x-transition:enter="transition ease-in-out duration-150"
        x-transition:enter-start="opacity-0 transform -translate-x-20"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-150"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0 transform -translate-x-20"
    >
        <div class="mb-6 animate">
            <div class="text-primary">
                <div class="flex justify-center pt-4">
                    <x-logo class="w-auto h-10" />
                </div>
                <div class="flex justify-center text-black dark:text-white">
                    <p class="italic font-semibold">{{ config('app.name') }}</p>
                </div>
                <div>
                    <ul class="mt-6 leading-10">
                        <x-sidebar.nav-item title="HALAMAN UTAMA" route="{{ route('home') }}" uri="home">
                            <x-heroicon-o-home class="w-7 h-7" />
                        </x-sidebar.nav-item>

                        <x-sidebar.nav-item title="MENU" route="#" uri="#">
                            <x-heroicon-o-chart-square-bar class="w-7 h-7" />
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