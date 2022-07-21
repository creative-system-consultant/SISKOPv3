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
            <div>
                <ul class="mt-3 leading-10">
                    <x-sidebar.nav-item title="HOME" route="{{route('home')}}" uri="home">
                        <x-heroicon-o-home class="w-7 h-7" />
                    </x-sidebar.nav-item>

                    <x-sidebar.nav-item title="Report" route="{{route('list-reporting')}}" uri="list-reporting">
                        <x-heroicon-o-clipboard-list class="w-7 h-7" />
                    </x-sidebar.nav-item>

                    <x-sidebar.dropdown-nav-item active="open" title="APPLICATION" uri="application/*">
                        <x-slot name="icon">
                            <x-heroicon-o-document-search class="w-7 h-7" />
                        </x-slot>
                        <div class="leading-5">
                            <x-sidebar.dropdown-item title="Apply Special Aid" href="{{ route('special-aid.apply') }}" uri="applySpecialAid">
                                <x-slot name="icon">
                                    <x-heroicon-o-archive class="w-7 h-7" />
                                </x-slot>
                            </x-sidebar.dropdown-item>
                            <x-sidebar.dropdown-item title="Apply Add Share" href="{{ route('share.apply') }}" uri="applyShare">
                                <x-slot name="icon">
                                    <x-heroicon-o-chart-pie class="w-7 h-7" />
                                </x-slot>
                            </x-sidebar.dropdown-item>
                            <x-sidebar.dropdown-item title="Apply Sell / Exchange Share" href="{{ route('share.sell') }}" uri="applySellShare">
                                <x-slot name="icon">
                                    <x-heroicon-o-switch-horizontal class="w-7 h-7" />
                                </x-slot>
                            </x-sidebar.dropdown-item>
                            <x-sidebar.dropdown-item title="Apply Contribution" href="{{ route('contribution.apply') }}" uri="applyContribution">
                                <x-slot name="icon">
                                    <x-heroicon-o-document-add class="w-7 h-7" />
                                </x-slot>
                            </x-sidebar.dropdown-item>
                            <x-sidebar.dropdown-item title="Apply Withdrawal Contribution" href="{{ route('contribution.withdraw') }}" uri="withdrawContribution">
                                <x-slot name="icon">
                                    <x-heroicon-o-document-remove class="w-7 h-7" />
                                </x-slot>
                            </x-sidebar.dropdown-item>
                        </div>
                    </x-sidebar.dropdown-nav-item> 

                    <x-sidebar.nav-item title="List of Application" route="{{route('application.list')}}" uri="applicationList">
                        <x-heroicon-o-document-text class="w-7 h-7" />                        
                    </x-sidebar.nav-item>

                    <x-sidebar.nav-item title="Customer Search" route="{{route('searchcustomer')}}" uri="searchcustomer">
                        <x-heroicon-o-search-circle class="w-7 h-7" />                        
                    </x-sidebar.nav-item>

                    <x-sidebar.dropdown-nav-item active="open" title="MAINTENANCE" uri="maintenance/*">
                        <x-slot name="icon">
                            <x-heroicon-o-cog class="w-7 h-7" />
                        </x-slot>
                        <x-sidebar.dropdown-item title="SPECIAL AID" href="{{ route('special_aid.list') }}" uri="specialAid/list">
                            <x-slot name="icon">
                                <x-heroicon-o-document-text class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-item title="COOP" href="{{ route('coop.list') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-document-text class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-nav-item type="2" active="open" title="REFERENCE" uri="reference/*">
                            <x-slot name="icon">
                                <x-heroicon-o-document-search class="w-7 h-7" />
                            </x-slot>
                            <div class="leading-5">
                                
                                <x-sidebar.dropdown-item title="BANK" href="{{ route('bank.list') }}" uri="bank">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>
                                
                                <x-sidebar.dropdown-item title="COUNTRY" href="{{ route('country.list') }}" uri="country">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="-2 0 24 17" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="RELIGION" href="{{ route('religion.list') }}" uri="religion">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 -80 600 600" stroke="currentColor" stroke-width="40">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M 94.924 366.674 h 312.874 c 0.958 0 1.886 -0.136 2.778 -0.349 c 0.071 0 0.13 0.012 0.201 0.012 c 6.679 0 12.105 -5.42 12.105 -12.104 V 12.105 C 422.883 5.423 417.456 0 410.777 0 h -2.955 H 114.284 H 94.941 c -32.22 0 -58.428 26.214 -58.428 58.425 c 0 0.432 0.085 0.842 0.127 1.259 c -0.042 29.755 -0.411 303.166 -0.042 339.109 c -0.023 0.703 -0.109 1.389 -0.109 2.099 c 0 30.973 24.252 56.329 54.757 58.245 c 0.612 0.094 1.212 0.183 1.847 0.183 h 317.683 c 6.679 0 12.105 -5.42 12.105 -12.105 v -45.565 c 0 -6.68 -5.427 -12.105 -12.105 -12.105 s -12.105 5.426 -12.105 12.105 v 33.461 H 94.924 c -18.395 0 -33.411 -14.605 -34.149 -32.817 c 0.018 -0.325 0.077 -0.632 0.071 -0.963 c -0.012 -0.532 -0.03 -1.359 -0.042 -2.459 C 61.862 380.948 76.739 366.674 94.924 366.674 Z M 103.178 58.425 c 0 -6.682 5.423 -12.105 12.105 -12.105 s 12.105 5.423 12.105 12.105 V 304.31 c 0 6.679 -5.423 12.105 -12.105 12.105 s -12.105 -5.427 -12.105 -12.105 V 58.425 Z"/>
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="STATE" href="{{ route('state.list') }}" uri="state">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 -3 30 30" stroke="currentColor" stroke-width="1.7">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M1 22h2v-22h18v22h2v2h-22v-2zm7-3v4h3v-4h-3zm5 0v4h3v-4h-3zm-6-5h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2zm-12-4h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2zm-12-4h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2zm-12-4h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2z"/>
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>
                                
                                <x-sidebar.dropdown-item title="GENDER" href="{{ route('gender.list') }}" uri="gender">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 -2 22 22" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1H11.5zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z"/>
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="EDUCATION" href="{{ route('education.list') }}" uri="education">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="RACE" href="{{ route('race.list') }}" uri="race">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="RELATIONSHIP" href="{{ route('relationship.list') }}" uri="relationship">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="TITLE" href="{{ route('title.list') }}" uri="title">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="MARITAL" href="{{ route('marital.list') }}" uri="marital">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>
                            </div>
                        </x-sidebar.dropdown-nav-item>
                    </x-sidebar.dropdown-nav-item>
                </ul>
            </div>
        </div>
    </div>
</aside>