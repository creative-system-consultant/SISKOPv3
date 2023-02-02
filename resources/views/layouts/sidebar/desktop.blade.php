<!-- Desktop sidebar -->
<x-sidebar-loading/>
<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}" />
<aside
    x-show="isSideMenuOpenDesktop"
    x-transition:enter="transition ease-in-out duration-300"
    x-transition:enter-start="opacity-0 transform -translate-x-20"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20"
    @keydown.escape="closeSideMenuDesktop"
    class="z-20 flex-shrink-0 hidden px-2 overflow-y-auto border-r-2 bg-gray-50 md:block dark:bg-gray-800 dark:border-gray-700" id="sidebar">

    <div class="mb-6 animate" id="nav-items">
        <div class="text-primary">
            <div class="flex justify-center pt-4">
                <x-logo class="w-auto h-8" />
            </div>
            <div>
                <ul class="mt-3 leading-10">
                    <x-sidebar.nav-item title="HOME" route="{{ route('home') }}" uri="home">
                        <x-heroicon-o-home class="w-7 h-7" />
                    </x-sidebar.nav-item>

                    <x-sidebar.nav-item title="Report" route="{{ route('list-reporting') }}" uri="list-reporting">
                        <x-heroicon-o-clipboard-list class="w-7 h-7" />
                    </x-sidebar.nav-item>

                    <x-sidebar.dropdown-nav-item active="open" title="APPLICATION" uri="application/*">
                        <x-slot name="icon">
                            <x-heroicon-o-document-search class="w-7 h-7" />
                        </x-slot>
                        <div class="leading-5">
                            <x-sidebar.dropdown-item title="Apply Membership" href="{{ route('membership.apply') }}" uri="">
                                <x-slot name="icon">
                                    <x-heroicon-o-document-add class="w-7 h-7" />
                                </x-slot>
                            </x-sidebar.dropdown-item>
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
                            <x-sidebar.dropdown-item title="Apply Financing" href="{{ route('financing.list') }}" uri="financingList">
                                <x-slot name="icon">
                                    <x-heroicon-o-scale class="w-7 h-7" />
                                </x-slot>
                            </x-sidebar.dropdown-item>
                        </div>
                    </x-sidebar.dropdown-nav-item>
                    <x-sidebar.nav-item title="List of Application" route="{{ route('application.list') }}" uri="applicationList">
                        <x-heroicon-o-document-text class="w-7 h-7" />
                    </x-sidebar.nav-item>
                    <x-sidebar.nav-item title="Customer Search" route="{{ route('customer.search') }}" uri="searchcustomer">
                        <x-heroicon-o-search-circle class="w-7 h-7" />
                    </x-sidebar.nav-item>
                    <x-sidebar.nav-item title="Register / Update Product" route="{{ route('product.list') }}" uri="product">
                        <x-heroicon-o-briefcase class="w-7 h-7" />
                    </x-sidebar.nav-item>
                    <x-sidebar.nav-item title="Membership Maintenance" route="{{ route('membership.admin') }}" uri="membership">
                        <x-heroicon-o-search-circle class="w-7 h-7" />
                    </x-sidebar.nav-item>

                    <x-sidebar.dropdown-nav-item active="open" title="ADMIN" uri="admin/*">
                        <x-slot name="icon">
                            <x-heroicon-o-user class="w-7 h-7" />
                        </x-slot>
                        <x-sidebar.dropdown-item title="COOP" href="{{ route('coop.list') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-library class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-item title="APPROVAL FINANCING" href="{{ url('Admin/Approval/Financing') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-chart-pie class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-item title="APPROVAL MEMBERSHIP" href="{{ url('Admin/Approval/Membership') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-chart-pie class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-item title="APPROVAL ADD SHARE" href="{{ url('Admin/Approval/Share') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-chart-pie class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-item title="APPROVAL SELL SHARE" href="{{ url('Admin/Approval/SellShare') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-chart-pie class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-item title="APPROVAL ADD CONTRIBUTION" href="{{ url('Admin/Approval/Contribution') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-chart-pie class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-item title="USER ROLE" href="{{ route('user.rolegroup') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-user-group class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-item  title="Register / Update Product" href="{{ route('product.list') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-briefcase class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-item title="Admin Membership" href="{{ route('membership.admin') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-document-text class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                    </x-sidebar.dropdown-nav-item>

                    <x-sidebar.dropdown-nav-item active="open" title="MAINTENANCE" uri="maintenance/*">
                        <x-slot name="icon">
                            <x-heroicon-o-cog class="w-7 h-7" />
                        </x-slot>
                        <x-sidebar.dropdown-item title="SPECIAL AID" href="{{ route('special_aid.list') }}" uri="specialAid/list">
                            <x-slot name="icon">
                                <x-heroicon-o-archive class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-item title="Add Customer Field" href="{{ route('coop.cust') }}" uri="">
                            <x-slot name="icon">
                                <x-heroicon-o-user-add class="w-7 h-7" />
                            </x-slot>
                        </x-sidebar.dropdown-item>
                        <x-sidebar.dropdown-nav-item type="2" active="open" title="REFERENCE" uri="reference/*">
                            <x-slot name="icon">
                                <x-heroicon-o-document-search class="w-7 h-7" />
                            </x-slot>
                            <div class="leading-5">
                                <x-sidebar.dropdown-item title="BANK" href="{{ route('bank.list') }}" uri="bank">
                                    <x-slot name="icon">
                                        <x-heroicon-o-library class="w-7 h-7" />
                                    </x-slot>
                                </x-sidebar.dropdown-item>
                                <x-sidebar.dropdown-item title="COUNTRY" href="{{ route('country.list') }}" uri="country">
                                    <x-slot name="icon">
                                        <x-heroicon-o-flag class="w-7 h-7" />
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="RELIGION" href="{{ route('religion.list') }}" uri="religion">
                                    <x-slot name="icon">
                                        <x-heroicon-o-hand class="w-7 h-7" />
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="STATE" href="{{ route('state.list') }}" uri="state">
                                    <x-slot name="icon">
                                        <x-heroicon-o-office-building class="w-7 h-7" />
                                    </x-slot>
                                </x-sidebar.dropdown-item>
                                <x-sidebar.dropdown-item title="GENDER" href="{{ route('gender.list') }}" uri="gender">
                                    <x-slot name="icon">
                                        <x-heroicon-o-users class="w-7 h-7" />
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="EDUCATION" href="{{ route('education.list') }}" uri="education">
                                    <x-slot name="icon">
                                        <x-heroicon-o-academic-cap class="w-7 h-7" />
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="RACE" href="{{ route('race.list') }}" uri="race">
                                    <x-slot name="icon">
                                        <x-heroicon-o-globe class="w-7 h-7" />
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="RELATIONSHIP" href="{{ route('relationship.list') }}" uri="relationship">
                                    <x-slot name="icon">
                                        <x-heroicon-o-link class="w-7 h-7" />
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="TITLE" href="{{ route('title.list') }}" uri="title">
                                    <x-slot name="icon">
                                        <x-heroicon-o-user-circle class="w-7 h-7" />
                                    </x-slot>
                                </x-sidebar.dropdown-item>

                                <x-sidebar.dropdown-item title="MARITAL" href="{{ route('marital.list') }}" uri="marital">
                                    <x-slot name="icon">
                                        <x-heroicon-o-terminal class="w-7 h-7" />
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