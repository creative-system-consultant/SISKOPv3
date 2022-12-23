<div class="p-4">
    <h1 class="text-base font-semibold md:text-2xl">Dashboard</h1>
    <div class="grid grid-cols-1 gap-10">
        <div class="mt-4">
            <div class="grid grid-cols-1 gap-10 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3">
                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <p>content 1</p>
                        <div id="pieChart"  wire:ignore></div>
                    </div>
                </x-general.card>

                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <p>content 2</p>
                    </div>
                </x-general.card>

                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <p>content 3</p>
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
                    </div>
                </x-general.card>

                <x-general.card class="p-4 bg-white rounded-lg shadow-md">
                    <div>
                        <p>content 6</p>
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
                        <p>content 8</p>
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
@endpush
