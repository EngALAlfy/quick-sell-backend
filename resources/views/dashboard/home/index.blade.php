@extends("layouts.dashboard")

@section("title" , __("Home"))

@section("content")
    <div class="row">
        @include("dashboard.home.sections.welcome")
        @include("dashboard.home.sections.sales_stock")
        @include("dashboard.home.sections.trends")
        <div class="col-12 col-md-8 col-lg-12 col-xl-4 order-3 order-md-2">
            <div class="row">
                @include("dashboard.home.sections.purchases")
                @include("dashboard.home.sections.adjustments")
                @include("dashboard.home.sections.sales_report")
            </div>
        </div>

    </div>

    <div class="row">
        @include("dashboard.home.sections.transaction_history")
        @include("dashboard.home.sections.order_statistics")
    </div>
@endsection

@push("styles")
    <link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/libs/apex-charts/apex-charts.css")}}">
@endpush

@push("scripts")
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{asset("assets/admin/sneat/vendor/libs/apex-charts/apexcharts.js")}}"></script>
    <script src="{{asset("assets/admin/sneat/js/dashboards-analytics.js")}}"></script>
    <script>
        // Initialize the Total Sales Chart
        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('ReportChart').getContext('2d');
            const ReportChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($monthlySales->pluck('month')),
                    datasets: [{
                        label: '{{__('Total Sales')}}',
                        data: @json($monthlySales->pluck('total_sales')),
                        backgroundColor: 'rgba(255, 205, 86, 0.5)',
                        borderColor: 'rgb(255, 205, 86)',
                        borderWidth: 2,
                        fill: true,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: '{{__('Months')}}'
                            }
                        },
                        y: {
                            title: {
                                display: true,
                                text: '{{__('Sales ($)')}}'
                            },
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        // Prepare stock data for the Stock Trends Chart
        const stockData = @json($stockData);
        const monthNames = ["{{__('Jan')}}", "{{__('Feb')}}", "{{__('Mar')}}", "{{__('Apr')}}", "{{__('May')}}", "{{__('Jun')}}", "{{__('Jul')}}", "{{__('Aug')}}", "{{__('Sep')}}", "{{__('Oct')}}", "{{__('Nov')}}", "{{__('Dec')}}"];
        const labels = stockData.map(item => monthNames[item.month - 1]);
        const purchases = stockData.map(item => item.purchases);
        const sales = stockData.map(item => item.sales);
        const returns = stockData.map(item => item.returns);

        // Initialize the Stock Trends Chart
        const ctx = document.getElementById('stockTrendsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: '{{__('Purchases')}}',
                        data: purchases,
                        backgroundColor: 'rgba(75, 192, 192, 0.5)',
                        borderColor: 'rgb(75, 192, 192)',
                        borderWidth: 1,
                        barPercentage: 0.6,
                    },
                    {
                        label: '{{__('Sales')}}',
                        data: sales,
                        backgroundColor: 'rgba(255, 99, 132, 0.5)',
                        borderColor: 'rgb(255, 99, 132)',
                        borderWidth: 1,
                        barPercentage: 0.6,
                    },
                    {
                        label: '{{__('Returns')}}',
                        data: returns,
                        backgroundColor: 'rgba(255, 205, 86, 0.5)',
                        borderColor: 'rgb(255, 205, 86)',
                        borderWidth: 1,
                        barPercentage: 0.6,
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: '{{__('Month')}}'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: '{{__('Quantity')}}'
                        },
                        beginAtZero: true
                    }
                }
            }
        });

        // Initialize the Top Products Sold Chart
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('topProductChartCanvas').getContext('2d');
            const topProductChartCanvas = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: {!! json_encode($chartData['labels']) !!},
                    datasets: [{
                        label: '{{__('Total Sold')}}',
                        data: {!! json_encode($chartData['data']) !!},
                        backgroundColor: [
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 1)',
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        tooltip: {
                            callbacks: {
                                label: function(tooltipItem) {
                                    return tooltipItem.label + ': ' + tooltipItem.raw;
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>
@endpush
