
<header class="relative py-2 bg-gradient-to-r from-primary-600 to-primary-700" >
    <div class="flex items-center justify-between px-6 mx-auto">
        <div class="flex items-center space-x-0 ">
            <!-- Mobile hamburger -->
            <button class="p-2 -ml-1 rounded-md bg-primary-800 hover:bg-primary-700 md:hidden focus:outline-none focus:shadow-outline-purple "
                @click="toggleSideMenu" aria-label="Menu">
                <x-heroicon-o-bars-3 class="w-6 h-6 text-white" />
            </button>

            <!-- Desktop hamburger -->
            <div class="hidden md:block" >
                <div class="flex justify-center px-2 py-1 rounded-md bg-primary-800 hover:bg-primary-700" @click="toggleSideMenuDesktop">
                    <button class="p-1 -ml-1 rounded-md focus:outline-none"
                            aria-label="Menu">
                            <template x-if="isSideMenuOpenDesktop" >
                                <x-heroicon-o-bars-2 class="w-6 h-6 text-white" x-cloak />
                            </template>
                            <template x-if="!isSideMenuOpenDesktop">
                                <x-heroicon-o-bars-3  class="w-6 h-6 text-white"  x-cloak/>
                            </template>
                    </button>
                </div>
            </div>
            <div class="hidden md:block">
                <div class="flex justify-center pl-4 text-white">
                    <p class="text-sm italic font-semibold uppercase md:text-xl">{{ config('app.name') }} {{ auth()->user()->user_current_client?->name }}</p>
                </div>
            </div>
        </div>

        <ul class="flex items-center flex-shrink-0 space-x-4">
            <div class="py-6"></div>
            <!-- Notifications menu -->
            <li class="relative" x-data="{open:false}">
                @php
                    $user = Auth::user();
                    //$customer = \App\Models\Customer::where('icno', $user->icno)->first();
                    //$specialAid = \App\Models\ApplySpecialAid::where('cust_id', $customer->id)->first();
                @endphp
                <button class="p-2 text-white align-middle bg-gray-800 rounded-md shadow-xl focus:outline-none "
                    @click="open=!open" @keydown.escape="open=false" aria-haspopup="true">
                    <div class="flex">
                        <x-heroicon-o-bell class="w-6 h-6" />
                    </div>
                    <!-- Notification badge -->
                    <span aria-hidden="true"
                        class="absolute top-0 inline-block px-1 text-xs transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full -right-2 dark:border-gray-800">
                            0
                    </span>
                </button>
                <div x-show="open" x-cloak>
                    <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" @keydown.escape="open=false"
                        @click.away="open = !open"
                        class="absolute right-0 z-50 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white rounded-md shadow-md dark:bg-gray-800">
                        @if (isset($specialAid) && $specialAid != NULL)
                            @foreach ($specialAid->notification as $notifyAid)
                                <li class="flex">
                                    <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold text-gray-500 transition-colors duration-150 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white"
                                        href="{{ url($notifyAid->link) }}">
                                        <span>{{ $notifyAid->title }}</span>
                                    </a>
                                </li>
                            @endforeach
                        @else
                            <li class="flex">
                                <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold text-gray-500 transition-colors duration-150 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white"
                                    href="#">
                                    <span>No Notification</span>
                                </a>
                            </li>
                        @endif
                        <li class="flex">
                            <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold text-gray-500 transition-colors duration-150 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white"
                                href="{{ route('notification') }}">
                                <span class="text-primary-500">Show All Notification</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Profile menu -->
            <li class="relative">
                <button
                    class="p-2 text-white align-middle rounded-md focus:outline-none "
                    @click="profile=!profile" @keydown.escape="profile=false" aria-haspopup="true">
                    <div class="flex items-center w-24 space-x-2 lg:w-full">
                        <img class="w-10 h-10 border-2 rounded-full border-primary-600" src="{{ asset('img/defaultUser.png') }}" alt="Rounded avatar">
                        <p class="text-sm uppercase truncate">
                            {{ auth()->user()->name }}
                            (
                                @if(auth()->user()->user_type == 2)
                                    CLIENT ADMIN
                                @elseif(auth()->user()->user_type == 3)
                                    CLIENT STAFF
                                @elseif(auth()->user()->user_type == 4)
                                    CLIENT MEMBER
                                @endif
                            )
                        </p>
                    </div>
                </button>
                <div x-show="profile" x-cloak>
                    <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" @click.away="profile = !profile"
                        class="absolute right-0 z-50 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white rounded-md shadow-md dark:bg-gray-800"
                        aria-label="submenu">
                        <li class="flex">
                            <button  onclick="window.location.reload(true);" class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold text-gray-500 transition-colors duration-150 rounded-md hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-white"
                                @click="darkMode = !darkMode">
                                <div class="flex items-center justify-center" x-show="!darkMode">
                                    <x-heroicon-o-moon class="w-5 h-5 mr-2" />
                                    Dark Mode
                                </div>
                                <div class="flex items-center justify-center" x-show="darkMode">
                                    <x-heroicon-o-sun class="w-5 h-5 mr-2" />
                                    <span>Light Mode</span>
                                </div>
                            </button>
                        </li>
                        <li class="flex">
                            <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold text-gray-500 transition-colors duration-150 rounded-md dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600"
                                href="{{ route('profile') }}">
                                <x-heroicon-o-user-circle class="w-5 h-5 mr-2" />
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="flex">
                            <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold text-gray-500 transition-colors duration-150 rounded-md dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600"
                                href="{{ route('dash.guest') }}">
                                <x-heroicon-o-arrow-up-circle class="w-5 h-5 mr-2" />
                                <span>Change Client</span>
                            </a>
                        </li>
                        <li class="flex">
                            <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold text-gray-500 transition-colors duration-150 rounded-md dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600"
                                href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5 mr-2" />
                                <span>Logout</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</header>
