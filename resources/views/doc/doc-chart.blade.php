<div class="p-6 bg-white rounded-md shadow-md ">
    <h2 class="mb-4 text-lg font-semibold border-b-2 border-gray-300">Pie/Donut Chart</h2>

    <x-general.accordion active="selected" tab="11" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Pie Chart</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div id="pieChart"  wire:ignore></div>
                </div>
                <p class="font-semibold">script</p>
                <pre class="-mt-4 language-js" wire:ignore>
                    <code class="language-js"> 
&#x40;push('js')
    &lt;script>
        var options = {
            series: [44, 55, 13, 43, 22],
            chart: {
                // width: 510,
                type: 'pie',
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

        var chart = new ApexCharts(document.getElementById('pieChart'), options);
        chart.render();
    &lt;/script>
&#x40;endpush
                    </code>
                </pre>
                <p class="font-semibold">blade</p>
                <pre class="-mt-4 language-php" wire:ignore >
                    <code class="language-php"> 
&lt;div id="pieChart" wire:ignore>&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>

    <x-general.accordion active="selected" tab="12" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Donut Chart</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div id="donutChart"  wire:ignore></div>
                </div>
                <p class="font-semibold">script</p>
                <pre class="-mt-4 language-js" wire:ignore>
                    <code class="language-js"> 
&#x40;push('js')
    &lt;script>
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
    &lt;/script>
&#x40;endpush
                    </code>
                </pre>
                <p class="font-semibold">blade</p>
                <pre class="-mt-4 language-php" wire:ignore >
                    <code class="language-php"> 
&lt;div id="donutChart" wire:ignore>&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>


</div>

<div class="p-6 bg-white rounded-md shadow-md ">
    <h2 class="mb-4 text-lg font-semibold border-b-2 border-gray-300">Line/Bar Chart</h2>

    <x-general.accordion active="selected" tab="13" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Line Chart</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div id="lineChart"  wire:ignore></div>
                </div>
                <p class="font-semibold">script</p>
                <pre class="-mt-4 language-js" wire:ignore>
                    <code class="language-js"> 
&#x40;push('js')
    &lt;script>
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
    &lt;/script>
&#x40;endpush
                    </code>
                </pre>
                <p class="font-semibold">blade</p>
                <pre class="-mt-4 language-php" wire:ignore >
                    <code class="language-php"> 
&lt;div id="lineChart" wire:ignore>&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>

    <x-general.accordion active="selected" tab="7895434345234234" bg="white">
        <x-slot name="title">
            <div class="flex items-center p-4 space-x-2 font-semibold rounded-md bg-gray-50">
                <p class="text-sm">Bar Chart</p>
            </div>
        </x-slot>
        <x-slot name="content">
            <div class="px-6 border-t-2">
                <div class="p-4 my-4 bg-white shadow-lg">
                    <div id="barChart"  wire:ignore></div>
                </div>
                <p class="font-semibold">script</p>
                <pre class="-mt-4 language-js" wire:ignore>
                    <code class="language-js"> 
&#x40;push('js')
    &lt;script>
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
            height: 350
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
        },
        yaxis: {
        title: {
            text: '$ (thousands)'
        }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
                }
        }
        };

        var chart = new ApexCharts(document.getElementById('barChart'), options);
        chart.render();
    &lt;/script>
&#x40;endpush
                    </code>
                </pre>
                <p class="font-semibold">blade</p>
                <pre class="-mt-4 language-php" wire:ignore >
                    <code class="language-php"> 
&lt;div id="barChart" wire:ignore>&lt;/div>
                    </code>
                </pre>
            </div>
        </x-slot>
    </x-general.accordion>


</div>

@push('js')
    <script>
        var options = {
            series: [44, 55, 13, 43, 22],
            chart: {
                // width: 510,
                type: 'pie',
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

        var chart = new ApexCharts(document.getElementById('pieChart'), options);
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
            height: 350
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
        },
        yaxis: {
        title: {
            text: '$ (thousands)'
        }
        },
        fill: {
            opacity: 1
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
                }
        }
        };


        var chart = new ApexCharts(document.getElementById('barChart'), options);
        chart.render();
    </script>
@endpush
