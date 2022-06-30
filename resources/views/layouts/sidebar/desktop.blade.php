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

                    <x-sidebar.nav-item title="Report" route="{{route('list-reporting')}}" uri="list-reporting">
                        <x-heroicon-o-clipboard-list class="w-7 h-7" />
                    </x-sidebar.nav-item>

                    <x-sidebar.dropdown-nav-item active="open" title="MAINTENANCE" uri="maintenance/*">
                        <x-slot name="icon">
                            <x-heroicon-o-cog class="w-7 h-7" />
                        </x-slot>
                        <div class="leading-5">
                            <x-sidebar.dropdown-item title="SPECIAL AID" href="{{ route('special_aid.list') }}" uri="specialAid/list">
                                <x-slot name="icon">
                                    <x-heroicon-o-document-text class="w-7 h-7" />
                                </x-slot>
                            </x-sidebar.dropdown-item>
                        </div>
                        <x-sidebar.dropdown-nav-item type="2" active="open" title="REFERENCE" uri="reference/*">
                            <x-slot name="icon">
                                <x-heroicon-o-document-search class="w-7 h-7" />
                            </x-slot>
                            <div class="leading-5">
                                
                                <x-sidebar.dropdown-item title="BANK" href="{{ route('bank') }}" uri="bank">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>
                                
                                <x-sidebar.dropdown-item title="COUNTRY" href="{{ route('country') }}" uri="country">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="-2 0 24 17" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.778.085A.5.5 0 0 1 15 .5V8a.5.5 0 0 1-.314.464L14.5 8l.186.464-.003.001-.006.003-.023.009a12.435 12.435 0 0 1-.397.15c-.264.095-.631.223-1.047.35-.816.252-1.879.523-2.71.523-.847 0-1.548-.28-2.158-.525l-.028-.01C7.68 8.71 7.14 8.5 6.5 8.5c-.7 0-1.638.23-2.437.477A19.626 19.626 0 0 0 3 9.342V15.5a.5.5 0 0 1-1 0V.5a.5.5 0 0 1 1 0v.282c.226-.079.496-.17.79-.26C4.606.272 5.67 0 6.5 0c.84 0 1.524.277 2.121.519l.043.018C9.286.788 9.828 1 10.5 1c.7 0 1.638-.23 2.437-.477a19.587 19.587 0 0 0 1.349-.476l.019-.007.004-.002h.001"/>
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="RELIGION" href="{{ route('religion') }}" uri="religion">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 -80 600 600" stroke="currentColor" stroke-width="40">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M 94.924 366.674 h 312.874 c 0.958 0 1.886 -0.136 2.778 -0.349 c 0.071 0 0.13 0.012 0.201 0.012 c 6.679 0 12.105 -5.42 12.105 -12.104 V 12.105 C 422.883 5.423 417.456 0 410.777 0 h -2.955 H 114.284 H 94.941 c -32.22 0 -58.428 26.214 -58.428 58.425 c 0 0.432 0.085 0.842 0.127 1.259 c -0.042 29.755 -0.411 303.166 -0.042 339.109 c -0.023 0.703 -0.109 1.389 -0.109 2.099 c 0 30.973 24.252 56.329 54.757 58.245 c 0.612 0.094 1.212 0.183 1.847 0.183 h 317.683 c 6.679 0 12.105 -5.42 12.105 -12.105 v -45.565 c 0 -6.68 -5.427 -12.105 -12.105 -12.105 s -12.105 5.426 -12.105 12.105 v 33.461 H 94.924 c -18.395 0 -33.411 -14.605 -34.149 -32.817 c 0.018 -0.325 0.077 -0.632 0.071 -0.963 c -0.012 -0.532 -0.03 -1.359 -0.042 -2.459 C 61.862 380.948 76.739 366.674 94.924 366.674 Z M 103.178 58.425 c 0 -6.682 5.423 -12.105 12.105 -12.105 s 12.105 5.423 12.105 12.105 V 304.31 c 0 6.679 -5.423 12.105 -12.105 12.105 s -12.105 -5.427 -12.105 -12.105 V 58.425 Z"/>
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="STATE" href="{{ route('state') }}" uri="state">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 -3 30 30" stroke="currentColor" stroke-width="1.7">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M1 22h2v-22h18v22h2v2h-22v-2zm7-3v4h3v-4h-3zm5 0v4h3v-4h-3zm-6-5h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2zm-12-4h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2zm-12-4h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2zm-12-4h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2z"/>
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>
                                
                                <x-sidebar.dropdown-item title="GENDER" href="{{ route('gender') }}" uri="gender">
                                    <x-slot name="icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 -2 22 22" stroke="currentColor" stroke-width="1.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1H11.5zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z"/>
                                        </svg>
                                    </x-slot>
                                </x-sidebar.dropdown-item>
                            
                            </div>
                        </x-sidebar.dropdown-nav-item>
                        
                    </x-sidebar.dropdown-nav-item>

                    {{-- <x-sidebar.dropdown-nav-item active="open" title="PERMOHONAN" uri="pemohonan/*">
                        <x-slot name="icon">
                            <x-heroicon-o-document-search class="w-7 h-7" />
                        </x-slot>
                        <div class="leading-5">
                            <x-sidebar.dropdown-item title="Apply Special Aid" href="{{ route('special-aid.apply') }}" uri="applySpecialAid">
                                <x-slot name="icon">
                                    <x-heroicon-o-document-text class="w-7 h-7" />
                                </x-slot>
                            </x-sidebar.dropdown-item>
                        </div>
                    </x-sidebar.dropdown-nav-item> --}}

                    <x-sidebar.nav-item title="SPECIAL AID"  route="{{ route('special_aid.list') }}" uri="specialAid/list">
                        <x-heroicon-o-archive class="w-7 h-7" />
                    </x-sidebar.nav-item>
                    <x-sidebar.nav-item title="BANK"  route="{{ route('bank') }}" uri="bank">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </x-sidebar.nav-item>
                    <x-sidebar.nav-item title="EDUCATION"  route="{{ route('education.list') }}" uri="education">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5z" />   <path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" /> <path stroke-linecap="round" stroke-linejoin="round" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222" />
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