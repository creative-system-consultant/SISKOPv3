<header class="relative py-2 bg-primary-800" >
    <div class="flex items-center justify-between px-6 mx-auto">
        <div class="flex items-center space-x-2 ">
            <!-- Mobile hamburger -->
            <button class="p-2 -ml-1 bg-gray-800 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple "
                @click="toggleSideMenu" aria-label="Menu">
                <x-heroicon-o-bars-3 class="w-6 h-6 text-white" />
            </button>

            <!-- Desktop hamburger -->
            <div class="hidden sm:block" >
                <div class="flex justify-center ">
                    <button class="p-1 -ml-1 rounded-md focus:outline-none"
                        @click="toggleSideMenuDesktop" aria-label="Menu">
                        <x-heroicon-o-bars-2  x-show="isSideMenuOpenDesktop" class="w-8 h-8 text-white" x-cloak />
                        <x-heroicon-o-bars-3  x-show="!isSideMenuOpenDesktop" class="w-8 h-8 text-white"  x-cloak/>
                    </button>
                </div>
            </div>
        </div>
        <ul class="flex items-center flex-shrink-0 space-x-4">
            <div class="py-6"></div>

            <!-- Profile menu -->
            <li class="relative" x-data="{open:false}">
                <button
                    class="p-2 text-white align-middle rounded-md focus:outline-none "
                    @click="open=!open" @keydown.escape="open=false" aria-haspopup="true">
                    <div class="flex items-center space-x-2">
                        <img class="w-10 h-10 rounded-full" src="{{ asset('img/defaultUser.png') }}" alt="Rounded avatar">
                        <p>USER</p>
                    </div>
                </button>
                <div x-show="open" x-cloak>
                    <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" @click.away="open = !open"
                        class="absolute right-0 z-50 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border rounded-md shadow-md"
                        aria-label="submenu">
                        <li class="flex">
                            <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold text-gray-500 transition-colors duration-150 rounded-md hover:bg-gray-100"
                                href="#">
                                <x-heroicon-o-user-circle class="w-5 h-5 mr-2" />
                                <span>Profile</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
        </ul>
    </div>
</header>
