<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Dashboard</h1>
    <div class="grid grid-cols-1 gap-10">
        <div class="mt-4">
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <p><span class="font-medium ">content 1</span></p>
                        <div id="pieChart"  wire:ignore></div>
                    </div>
                </x-general.card>

                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <p><span class="font-medium ">content 2</span></p>
                        <div id="lineChart" wire:ignore></div>
                    </div>
                </x-general.card>

                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <p><span class="font-medium ">MEMBER INFO</span></p>
                        <p><x-table.table>
                                <x-slot name="thead"></x-slot>
                                <x-slot name="tbody">
                                        <tr>
                                            <x-table.table-body colspan="" class="text-left">
                                                CONTRIBUTION
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-left">
                                                RM 3,001
                                            </x-table.table-body>
                                        </tr>
                                        <tr>
                                            <x-table.table-body colspan="" class="text-left">
                                                SHARE
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-left">
                                                RM 50,001
                                            </x-table.table-body>
                                        </tr>
                                        <tr>
                                            <x-table.table-body colspan="" class="text-left">
                                                e-WALLET
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-left">
                                                RM 7,900
                                            </x-table.table-body>
                                        </tr>
                                </x-slot>
                            </x-table.table>
                        </p>
                    </div>
                </x-general.card>

                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <p>content 4</p>
                        <div id="barChart" wire:ignore></div>
                    </div>
                </x-general.card>

                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <p>content 5</p>
                        <div id="donutChart" wire:ignore></div>
                    </div>
                </x-general.card>

                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <p><span class="font-medium ">{{ $Client->name }}</span></p>
                        <p>
                            <x-table.table>
                                <x-slot name="thead">
                                    <x-table.table-header class="text-left" value="Title" sort="" />
                                    <x-table.table-header class="text-left" value="Detail" sort="" />
                                </x-slot>
                                <x-slot name="tbody">
                                        <tr>
                                            <x-table.table-body colspan="" class="text-left">
                                                ID
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-left">
                                                {{ $Client->id }}
                                            </x-table.table-body>
                                        </tr>
                                        <tr>
                                            <x-table.table-body colspan="" class="text-left">
                                                Fullname
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-left">
                                                {{ $Client->name }}
                                            </x-table.table-body>
                                        </tr>
                                        <tr>
                                            <x-table.table-body colspan="" class="text-left">
                                                Shortform
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-left">
                                                {{ $Client->name2 }}
                                            </x-table.table-body>
                                        </tr>
                                        <tr>
                                            <x-table.table-body colspan="" class="text-left">
                                                Description
                                            </x-table.table-body>
                                            <x-table.table-body colspan="" class="text-left">
                                                {{ $Client->description }}
                                            </x-table.table-body>
                                        </tr>
                                        <tr>
                                            <x-table.table-body colspan="2" class="text-left">
                                                <button type="button" wire:click="logout" class="flex items-center justify-center p-2 text-sm font-semibold text-white bg-red-500 rounded-md focus:outline-none">
                                                    Logout
                                                </button>
                                            </x-table.table-body>
                                        </tr>
                                </x-slot>
                            </x-table.table>
                        </p>
                    </div>
                </x-general.card>
            </div>

            <div class="grid grid-cols-12 gap-x-0 md:gap-x-10 gap-y-10 mt-10 h-[82vh]">
                <x-general.card class="col-span-12 p-4 bg-white rounded-lg shadow-md sm:col-span-12 md:col-span-8 lg:col-span-8 xl:col-span-8">
                    <div>
                        <p>Work Queue</p>
                        <div><livewire:page.dashboard.executive.dash-exec-work-queue /></div>
                    </div>
                </x-general.card>
                <x-general.card class="col-span-12 p-4 bg-white rounded-lg shadow-md sm:col-span-12 md:col-span-4 lg:col-span-4 xl:col-span-4">
                    <div>
                        <p class="text-xl mb-2">PROMOSI</p>
                        <p class="my-2">KELAB GOLF SERI SELANGOR</p>
                        <p class="my-2"><img class="mx-auto w-auto" src="{{ asset('storage/client/blog/picture 2.png') }}" alt="promo"></p>
                        <p class="my-2">To obtain further information or assistance, kindly contact us via phone at +603 7806 xxxx / +6019 299 xxxx or email us at  xxxxxxx@seriselangor.com.my</p>
                        <p class="my-2">Thank you for your interest and we look forward to hearing from you soon.</p>
                    </div>
                </x-general.card>

                <x-general.card class="col-span-12 p-4 bg-white rounded-lg shadow-md sm:col-span-12 md:col-span-12 lg:col-span-12 xl:col-span-12 ">
                    <div>
                        <p>content 9</p>
                    </div>
                </x-general.card>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>
        var darkModeColor;
        if(localStorage.getItem('darkMode') == 'true'){
            darkModeColor = '#ffffff';
        }else{
            darkModeColor = '#000000';
        }
        var options = {
            series: [44, 55, 13, 43, 22],
            chart: {
                // width: 510,
                type: 'pie',
            },
            dataLabels: {
                style: {
                    fontSize: "12px",
                    fontWeight: "bold",
                },
            },
            tooltip: {
                style: {
                    fontSize: '12px',
                    colors:'#000000',
                }
            },
            labels: ['label 1', 'label 2','label 3','label 4','label 5',],
            legend: {
                position: 'bottom',
                labels: {
                    colors: darkModeColor,
                },
            },
            responsive: [{
                // breakpoint: 480,
                options: {
                        chart: {
                        // width: 450
                    },
                    legend: {
                        position: 'bottom',
                    },
                }
            }]
        };
        var chart = new ApexCharts(document.getElementById('pieChart'), options);
        chart.render();
    </script>
    <script>
        var options = {
            series: [{
                name: 'Net Profit',
                data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
            }, {
                name: 'Revenue',
                data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
            }, {
                name: 'Free Cash Flow',
                data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
            }],
            chart: {
                type: 'bar',
                // height: 300,
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
                labels: {
                    style: {
                        colors: darkModeColor,
                    },
                },
            },
            yaxis: {
                labels: {
                    style: {
                        colors: darkModeColor,
                    },
                },
            },
            fill: {
                opacity: 1
            },
            legend: {
                labels: {
                    colors: darkModeColor,
                },
            },
            };

            var chart = new ApexCharts(document.getElementById('barChart'), options);
            chart.render();
        </script>
        <script>
            var options = {
                series: [{
                    name: "Desktops",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }],
                    chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                    enabled: false
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'straight'
                },
                title: {
                    text: 'Product Trends by Month',
                    align: 'left'
                },
                grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                },
                xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                }
                };

            var chart = new ApexCharts(document.getElementById('lineChart'), options);
            chart.render();
        </script>
        <script>
        var options = {
            series: [44, 55, 13, 43, 22],
            chart: {
                // width: 510,
                type: 'donut',
            },
            dataLabels: {
                style: {
                    fontSize: "20px",
                    fontWeight: "bold",
                },
            },
            tooltip: {
                style: {
                    fontSize: '25px',
                    colors:'#000000',
                }
            },
            labels: ['label 1', 'label 2','label 3','label 4','label 5',],
            responsive: [{
                breakpoint: 480,
                options: {
                        chart: {
                        width: 450
                    },
                    legend: {
                        position: 'bottom',
                    },
                }
            }]
        };

        var chart = new ApexCharts(document.getElementById('donutChart'), options);
        chart.render();
    </script>
@endpush
