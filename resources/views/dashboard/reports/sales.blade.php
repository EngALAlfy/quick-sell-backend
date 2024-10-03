@extends("layouts.dashboard")

@section("title", __('Sales Report'))

@section("content")
    <div class="row gutters">
        <!-- Filters Section -->
        <div class="col-md-12">
            <div class="card mb-2">
                <div class="card-body">
                    {{-- <form id="salesReportForm"> --}}
                        <div class="align-items-center justify-content-between row">
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-md-3 me-4">
                                        <label for="filter">{{ __('Report Type') }}</label>
                                        <select id="reportType" class="form-select">
                                            <option value="daily">{{ __('Life Time') }}</option>
                                            <option value="daily">{{ __('Yearly') }}</option>
                                            <option value="monthly">{{ __('Monthly') }}</option>
                                            <option value="weekly">{{ __('Weekly') }}</option>
                                            <option value="daily">{{ __('Daily') }}</option>
                                        </select>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="dateRange">{{ __('Date Range') }}</label>
                                        <div class="d-flex">
                                            <input class="form-control" type="week" value="2021-W25" id="html5-week-input">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 text-end">
                                <button type="button" class="btn btn-primary" onclick="fetchSalesReport()">{{ __('Generate Report') }}</button>
                            </div>
                        </div>
                        {{-- <button type="button" class="btn btn-primary" onclick="fetchSalesReport()">{{ __('Generate Report') }}</button>
                    </form> --}}
                </div>
            </div>
        </div>

        <!-- Daily/Weekly/Monthly Sales Report -->
        {{-- <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Sales Overview') }}</h5>
                </div>
                <div class="card-body">
                    <p>{{ __('Total Revenue:') }} <span id="totalRevenue">$0.00</span></p>
                    <p>{{ __('Number of Transactions:') }} <span id="totalTransactions">0</span></p>
                    <p>{{ __('Average Sale per Customer:') }} <span id="averageSale">$0.00</span></p>
                </div>
            </div>
        </div> --}}

        <!-- Sales by Product -->
        {{-- <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Sales by Product') }}</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="salesByProductTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('Product Name') }}</th>
                            <th>{{ __('SKU') }}</th>
                            <th>{{ __('Quantity Sold') }}</th>
                            <th>{{ __('Total Revenue') }}</th>
                        </tr>
                        </thead>
                        <tbody id="salesByProductBody">
                        <!-- Sales data will be populated here via jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        <!-- Sales by Category -->
        {{-- <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Sales by Category') }}</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="salesByCategoryTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Total Sales') }}</th>
                        </tr>
                        </thead>
                        <tbody id="salesByCategoryBody">
                        <!-- Sales data will be populated here via jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        <!-- Sales by Payment Method -->
        {{-- <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Sales by Payment Method') }}</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="salesByPaymentMethodTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('Payment Method') }}</th>
                            <th>{{ __('Total Sales') }}</th>
                        </tr>
                        </thead>
                        <tbody id="salesByPaymentMethodBody">
                        <!-- Sales data will be populated here via jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        <!-- Refunds/Returns Report -->
        {{-- <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Refunds/Returns Report') }}</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="refundsTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('Product Name') }}</th>
                            <th>{{ __('SKU') }}</th>
                            <th>{{ __('Quantity Returned') }}</th>
                            <th>{{ __('Refund Amount') }}</th>
                            <th>{{ __('Reason') }}</th>
                        </tr>
                        </thead>
                        <tbody id="refundsBody">
                        <!-- Refunds data will be populated here via jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>

    <div class="row mb-4">
        <div class="col-xxl-4 col-md-2 col-4 mb-6">
            <div class="card" style="min-height: 100%;">
                <div class="card-body">
                    <div class="align-items-center d-flex flex-column flex-sm-row gap-4 justify-content-between" style="position: relative;">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                        <div class="card-title mb-6">
                        <h5 class="text-nowrap mb-1">Sales</h5>
                        <span class="badge bg-label-dark">Total: 125</span>
                        </div>
                        <div class="mt-sm-auto">
                        <span class="text-success text-nowrap fw-medium"><i class="bx bx-up-arrow-alt"></i> 68.2%</span>
                        <h4 class="mb-0">$84,686k</h4>
                        </div>
                    </div>
                    <div id="salesChart" style="min-height: 75px;"></div>
                    <div class="resize-triggers"><div class="expand-trigger"><div style="width: 338px; height: 140px;"></div></div><div class="contract-trigger"></div></div></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-2 col-md-2 col-2 mb-6">
            <div class="card h-100">
              <div class="card-body pb-0">
                <span class="d-block fw-medium mb-1">Purchases</span>
                <h4 class="card-title mb-0">276k</h4>
              </div>
              <div id="purchasesChart" class="" style="min-height: 80px;"></div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 181px; height: 199px;"></div></div><div class="contract-trigger"></div></div></div>
        </div>
        <div class="col-xxl-2 col-md-2 col-2 mb-6">
            <div class="card h-100">
              <div class="card-body pb-0">
                <span class="d-block fw-medium mb-1">Profit</span>
                <h4 class="card-title mb-0">276k</h4>
              </div>
              <div id="profitChart" class="" style="min-height: 80px;"></div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 181px; height: 199px;"></div></div><div class="contract-trigger"></div></div></div>
        </div>
        <div class="col-xxl-2 col-md-2 col-2 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                    <div class="avatar flex-shrink-0">
                        <img src="{{ asset('assets/admin/img/icons/cash-flow.png') }}" alt="Credit Card" class="rounded">
                    </div>
                </div>
                <p class="mb-1">Transactions</p>
                <h4 class="card-title mb-0">$14,857</h4>
              </div>
            </div>
        </div>
        <div class="col-xxl-2 col-md-2 col-2 mb-6">
            <div class="card h-100">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between mb-4">
                  <div class="avatar flex-shrink-0">
                    <img src="{{ asset('assets/admin/img/icons/customers.png') }}" alt="Credit Card" class="rounded">
                  </div>
                </div>
                <p class="mb-1">Clients</p>
                <h4 class="card-title mb-0">50</h4>
              </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between pb-0">
                    <div class="align-items-center card-title d-flex mb-0">
                        <i class="fa-chart-simple fa-solid me-2 text-black-50"></i>
                      <h5 class="mb-0">Top 10 Products Sales</h5>
                    </div>
                </div>
                <div class="card-body">
                    <div id="top-products-chart"></div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="align-items-center card-title d-flex mb-0">
                        <i class="fa-chart-simple fa-solid me-2 text-black-50"></i>
                      <h5 class="mb-0">Category Sales Analysis</h5>
                    </div>
                </div>
                <div class="align-content-center align-self-center card-body justify-content-center">
                    <div id="category-analysis-chart"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-3 col-xl-3 col-md-4">
            <div class="card h-100">
                <div class="card-header pb-0 d-flex align-items-center justify-content-between">
                    <div class="align-items-center card-title d-flex mb-0">
                        <i class="fa-chart-simple fa-solid me-2 text-black-50"></i>
                        <h5 class="card-title m-0 me-2">Yearly Sales Stats</h5>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div id="salesStats"></div>
                </div>
            </div>
        </div>
        <div class="col-4 col-xl-4 col-md-4">
            <div class="card h-100">
              <div class="card-header d-flex align-items-center justify-content-between">
                <div class="align-items-center card-title d-flex mb-0">
                    <i class="fa-chart-simple fa-solid me-2 text-black-50"></i>
                    <h5 class="card-title m-0 me-2">Sales by Payment Method</h5>
                </div>
              </div>
              <div class="card-body">
                <ul class="list-unstyled mb-0">
                  <li class="align-items-center d-flex mb-2">
                    <div class="avatar flex-shrink-0 me-4">
                      <span class="avatar-initial rounded bg-label-success"><i class='bx bx-money-withdraw' ></i></span>
                    </div>
                    <div class="row w-100 align-items-center">
                      <div class="col-sm-8 col-md-12 col-xxl-8 mb-1 mb-sm-0 mb-md-1 mb-xxl-0">
                        <h6 class="mb-0">Cash</h6>
                      </div>
                      <div class="col-sm-4 col-md-12 col-xxl-4 d-flex justify-content-xxl-end">
                        <div class="badge bg-label-secondary">3.7k EGP</div>
                      </div>
                    </div>
                  </li>
                  <li class="align-items-center d-flex mb-2">
                    <div class="avatar flex-shrink-0 me-4">
                      <span class="avatar-initial rounded bg-label-warning"><i class='bx bxs-credit-card' ></i></span>
                    </div>
                    <div class="row w-100 align-items-center">
                      <div class="col-sm-8 col-md-12 col-xxl-8 mb-1 mb-sm-0 mb-md-1 mb-xxl-0">
                        <h6 class="mb-0">Credit Card</h6>
                      </div>
                      <div class="col-sm-4 col-md-12 col-xxl-4 d-flex justify-content-xxl-end">
                        <div class="badge bg-label-secondary">2.5k EGP</div>
                      </div>
                    </div>
                  </li>
                  <li class="align-items-center d-flex mb-2">
                    
                    <div class="avatar flex-shrink-0 me-4">
                      <span class="avatar-initial rounded bg-label-danger"><i class='bx bxs-wallet'></i></span>
                    </div>
                    <div class="row w-100 align-items-center">
                      <div class="col-sm-8 col-md-12 col-xxl-8 mb-1 mb-sm-0 mb-md-1 mb-xxl-0">
                        <h6 class="mb-0">Wallet</h6>
                      </div>
                      <div class="col-sm-4 col-md-12 col-xxl-4 d-flex justify-content-xxl-end">
                        <div class="badge bg-label-secondary">948 EGP</div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
        </div>
        <div class="col-5 col-xl-5 col-md-4">
            <div class="card h-100">
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="card-header d-flex justify-content-between">
                            <div class="align-items-center card-title d-flex mb-0">
                                <i class="fa-chart-simple fa-solid me-2 text-black-50"></i>
                                <h5 class="card-title m-0 me-2">Clients Analysis</h5>
                            </div>
                        </div>
                        <div class="card-body" style="position: relative;">
                            <div class="d-flex flex-column gap-1 mt-4">
                                <h3 class="mb-1">8,258</h3>
                                <small>Total Clients</small>
                            </div>
                            <div class=" me-1 mt-2"><span class="badge bg-label-success">+42 New client</span> This Month</div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body pt-lg-6">
                            <div id="growthChart" style="min-height: 154.875px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    <div class="row">
        <div class="col-8">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <div class="align-items-center card-title d-flex mb-0">
                            <i class="fa-chart-simple fa-solid me-2 text-black-50"></i>
                            <h5 class="mb-1">Sales Report</h5>
                        </div>
                        <p class="mt-2 card-subtitle">
                            Total number of sales 23.8k <strong>(560K EGP)</strong>
                            <span class="fw-medium ms-3 text-danger text-nowrap">
                                <i class="bx bx-down-arrow-alt"></i>
                                8.2%
                            </span>
                        </p>
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <div id="salesDetailsChart"></div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between">
                    <div class="card-title mb-0">
                        <div class="align-items-center card-title d-flex mb-0">
                            <i class="fa-chart-simple fa-solid me-2 text-black-50"></i>
                            <h5 class="mb-1 me-2">Earning Reports</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body d-flex flex-column justify-content-between pb-0" style="position: relative;">
                    <ul class="p-0 m-0">
                        <li class="d-flex mb-3 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-primary">
                                    <i class="bx bx-trending-up"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Net Profit</h6>
                                    <small class="text-muted">12.4k Sales</small>
                                </div>
                                <div class="user-progress">
                                    <span class="me-3">$1,619</span><i class="bx bx-chevron-up text-success ms-1"></i> <span>18.6%</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-3 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-dollar"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Total Income</h6>
                                    <small class="text-muted">Sales, Affiliation</small>
                                </div>
                                <div class="user-progress">
                                    <span class="me-3">$3,571</span>
                                    <i class="bx bx-chevron-up text-success ms-1"></i>
                                    <span>39.6%</span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-3 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-secondary">
                                    <i class="bx bx-credit-card"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                <div class="me-2">
                                    <h6 class="mb-0">Total Expenses</h6>
                                    <small class="text-muted">ADVT, Marketing</small>
                                </div>
                                <div class="user-progress">
                                    <span class="me-3">$430</span><i class="bx bx-chevron-up text-success ms-1"></i> <span>52.8%</span>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div id="earningChart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function salesChart() {
            var options = {
                chart: {
                    height: 75,
                    type: "line",
                    toolbar: {
                        show: !1
                    },
                    dropShadow: {
                        enabled: !0,
                        top: 10,
                        left: 5,
                        blur: 3,
                        color: config.colors.warning,
                        opacity: .15
                    },
                    sparkline: {
                        enabled: !0
                    }
                },
                grid: {
                    show: !1,
                    padding: {
                        right: 8
                    }
                },
                colors: [config.colors.warning],
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    width: 5,
                    curve: "smooth"
                },
                series: [{
                    data: [110, 270, 145, 245, 205, 285]
                }],
                xaxis: {
                    show: !1,
                    lines: {
                        show: !1
                    },
                    labels: {
                        show: !1
                    },
                    axisBorder: {
                        show: !1
                    }
                },
                yaxis: {
                    show: !1
                },
                tooltip: {
                    enabled: false
                }
            }
            var chart = new ApexCharts(document.querySelector("#salesChart"), options);
            chart.render();
        }

        function purchasesChart() {
            var options = {
                chart: {
                    height: 80,
                    type: "area",
                    toolbar: {
                        show: !1
                    },
                    sparkline: {
                        enabled: !0
                    }
                },
                markers: {
                    size: 6,
                    colors: "transparent",
                    strokeColors: "transparent",
                    strokeWidth: 4,
                    discrete: [{
                        fillColor: '#FFFFFF',
                        seriesIndex: 0,
                        dataPointIndex: 6,
                        strokeColor: config.colors.info,
                        strokeWidth: 2,
                        size: 6,
                        radius: 8
                    }],
                    hover: {
                        size: 7
                    }
                },
                grid: {
                    show: !1,
                    padding: {
                        right: 8
                    }
                },
                colors: [config.colors.info],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: '#FFF2D9',
                        shadeIntensity: .8,
                        opacityFrom: .8,
                        opacityTo: .25,
                        stops: [0, 85, 100]
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    width: 2,
                    curve: "smooth"
                },
                series: [{
                    data: [180, 175, 275, 140, 205, 190, 295]
                }],
                xaxis: {
                    show: !1,
                    lines: {
                        show: !1
                    },
                    labels: {
                        show: !1
                    },
                    stroke: {
                        width: 0
                    },
                    axisBorder: {
                        show: !1
                    }
                },
                yaxis: {
                    stroke: {
                        width: 0
                    },
                    show: !1
                },
                tooltip: {
                    enabled: false
                }
            }
            var chart = new ApexCharts(document.querySelector("#purchasesChart"), options);
            chart.render();
        }

        function profitChart() {
            var options = {
                chart: {
                    height: 80,
                    type: "area",
                    toolbar: {
                        show: !1
                    },
                    sparkline: {
                        enabled: !0
                    }
                },
                markers: {
                    size: 6,
                    colors: "transparent",
                    strokeColors: "transparent",
                    strokeWidth: 4,
                    discrete: [{
                        fillColor: '#FFFFFF',
                        seriesIndex: 0,
                        dataPointIndex: 6,
                        strokeColor: config.colors.success,
                        strokeWidth: 2,
                        size: 6,
                        radius: 8
                    }],
                    hover: {
                        size: 7
                    }
                },
                grid: {
                    show: !1,
                    padding: {
                        right: 8
                    }
                },
                colors: [config.colors.success],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: '#FFF2D9',
                        shadeIntensity: .8,
                        opacityFrom: .8,
                        opacityTo: .25,
                        stops: [0, 85, 100]
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                stroke: {
                    width: 2,
                    curve: "smooth"
                },
                series: [{
                    data: [180, 175, 275, 140, 205, 190, 295]
                }],
                xaxis: {
                    show: !1,
                    lines: {
                        show: !1
                    },
                    labels: {
                        show: !1
                    },
                    stroke: {
                        width: 0
                    },
                    axisBorder: {
                        show: !1
                    }
                },
                yaxis: {
                    stroke: {
                        width: 0
                    },
                    show: !1
                },
                tooltip: {
                    enabled: false
                }
            }
            var chart = new ApexCharts(document.querySelector("#profitChart"), options);
            chart.render();
        }

        function topProductsChart() {
            var options = {
                series: [
                    {
                        name: 'This Month',
                        data: [
                        {
                            x: 'Milk',
                            y: 112,
                            goals: [
                            {
                                name: 'Previous Month',
                                value: 99,
                                strokeWidth: 2,
                                strokeDashArray: 2,
                                strokeColor: '#775DD0'
                            }
                            ]
                        },
                        {
                            x: 'Food',
                            y: 88,
                            goals: [
                            {
                                name: 'Previous Month',
                                value: 40,
                                strokeWidth: 2,
                                strokeDashArray: 2,
                                strokeColor: '#775DD0'
                            }
                            ]
                        },
                        {
                            x: 'Meat',
                            y: 76,
                            goals: [
                            {
                                name: 'Previous Month',
                                value: 38,
                                strokeWidth: 2,
                                strokeDashArray: 2,
                                strokeColor: '#775DD0'
                            }
                            ]
                        },
                        {
                            x: 'Egg',
                            y: 100,
                            goals: [
                            {
                                name: 'Previous Month',
                                value: 118,
                                strokeWidth: 2,
                                strokeDashArray: 2,
                                strokeColor: '#775DD0'
                            }
                            ]
                        },
                        {
                            x: 'sweet',
                            y: 112,
                            goals: [
                            {
                                name: 'Previous Month',
                                value: 99,
                                strokeWidth: 2,
                                strokeDashArray: 2,
                                strokeColor: '#775DD0'
                            }
                            ]
                        },
                        {
                            x: 'Rice',
                            y: 45,
                            goals: [
                            {
                                name: 'Previous Month',
                                value: 12,
                                strokeWidth: 2,
                                strokeDashArray: 2,
                                strokeColor: '#775DD0'
                            }
                            ]
                        },
                        {
                            x: 'Koshary',
                            y: 60,
                            goals: [
                            {
                                name: 'Previous Month',
                                value: 87,
                                strokeWidth: 2,
                                strokeDashArray: 2,
                                strokeColor: '#775DD0'
                            }
                            ]
                        },
                        {
                            x: 'Olive oil',
                            y: 10,
                            goals: [
                            {
                                name: 'Previous Month',
                                value: 15,
                                strokeWidth: 2,
                                strokeDashArray: 2,
                                strokeColor: '#775DD0'
                            }
                            ]
                        },
                        {
                            x: 'Tometo',
                            y: 98,
                            goals: [
                            {
                                name: 'Previous Month',
                                value: 99,
                                strokeWidth: 2,
                                strokeDashArray: 2,
                                strokeColor: '#775DD0'
                            }
                            ]
                        },   
                        {
                            x: 'Orange',
                            y: 112,
                            goals: [
                            {
                                name: 'Previous Month',
                                value: 99,
                                strokeWidth: 2,
                                strokeDashArray: 2,
                                strokeColor: '#775DD0'
                            }
                            ]
                        },
                        ]
                    }
                ],
                chart: {
                    height: 350,
                    type: 'bar',
                    toolbar: {
                        show: false
                    },
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        },
                        dynamicAnimation: {
                            enabled: true,
                            speed: 350
                        }
                    }
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    }
                },
                colors: ['#00E396'],
                dataLabels: {
                    formatter: function(val, opt) {
                        const goals =
                        opt.w.config.series[opt.seriesIndex].data[opt.dataPointIndex]
                            .goals
                    
                        if (goals && goals.length) {
                        return `${val}`
                        }
                        return val
                    }
                },
                legend: {
                    show: true,
                    showForSingleSeries: true,
                    customLegendItems: ['This Month', 'Previous Month'],
                    markers: {
                        fillColors: ['#00E396', '#775DD0']
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#top-products-chart"), options);
            chart.render();
        }

        function categoryAnalysisChart() {
            var seriesData = [42, 47, 52, 58, 65];
            var total = seriesData.reduce((a, b) => a + b, 0); // Sum of all series values

            var options = {
                series: seriesData,
                chart: {
                    width: 520,
                    type: 'polarArea'
                },
                labels: ['البان', 'خضروات', 'فواكه', 'لحوم', 'عصائر'],
                fill: {
                    opacity: 1
                },
                stroke: {
                    width: 1,
                    colors: undefined
                },
                yaxis: {
                    show: false
                },
                legend: {
                    position: 'right',
                    formatter: function(seriesName, opts) {
                        var percentage = (opts.w.globals.series[opts.seriesIndex] / total * 100).toFixed(2);
                        return seriesName + ' (' + percentage + '%)';
                    }
                },
                plotOptions: {
                    polarArea: {
                        rings: {
                            strokeWidth: 0
                        },
                        spokes: {
                            strokeWidth: 0
                        },
                    }
                },
                theme: {
                    monochrome: {
                        enabled: false,
                        shadeTo: 'light',
                        shadeIntensity: 0.6
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#category-analysis-chart"), options);
            chart.render();
        }

        function salesStats() {
            var options = {
                chart: {
                    height: 190,
                    type: "radialBar"
                },
                series: [75],
                labels: ["Sales"],
                plotOptions: {
                    radialBar: {
                        startAngle: 0,
                        endAngle: 360,
                        strokeWidth: "70",
                        hollow: {
                            margin: 50,
                            size: "75%",
                            imageWidth: 65,
                            imageHeight: 55,
                            imageOffsetY: -35,
                            imageClipped: !1
                        },

                        track: {
                            strokeWidth: "50%",
                            background: '#E8EAEB'
                        },
                        dataLabels: {
                            show: !0,
                            name: {
                                offsetY: 60,
                                show: !1,
                                color: config.colors.success,
                                fontSize: "15px",
                                fontFamily: "Public Sans"
                            },
                            value: {
                                formatter: function(o) {
                                    return parseInt(o) + "%"
                                },
                                offsetY: 10,
                                color: config.colors.success,
                                fontSize: "28px",
                                fontWeight: "500",
                                fontFamily: "Public Sans",
                                show: !0
                            }
                        }
                    }
                },
                fill: {
                    type: "solid",
                    colors: config.colors.success
                },
                stroke: {
                    lineCap: "round"
                },
                states: {
                    hover: {
                        filter: {
                            type: "none"
                        }
                    },
                    active: {
                        filter: {
                            type: "none"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#salesStats"), options);
            chart.render();
        }

        function growthChart() {
            var options = {
                series: [78],
                labels: ["Growth"],
                chart: {
                    height: 240,
                    type: "radialBar"
                },
                plotOptions: {
                    radialBar: {
                        size: 150,
                        offsetY: 10,
                        startAngle: -150,
                        endAngle: 150,
                        hollow: {
                            size: "55%"
                        },
                        track: {
                            background: '#fff',
                            strokeWidth: "100%"
                        },
                        dataLabels: {
                            name: {
                                offsetY: 15,
                                color: config.colors.primary,
                                fontSize: "15px",
                                fontWeight: "500",
                                fontFamily: "Public Sans"
                            },
                            value: {
                                offsetY: -25,
                                color: config.colors.primary,
                                fontSize: "22px",
                                fontWeight: "500",
                                fontFamily: "Public Sans"
                            }
                        }
                    }
                },
                colors: [config.colors.primary],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        shadeIntensity: .5,
                        gradientToColors: [config.colors.primary],
                        inverseColors: !0,
                        opacityFrom: 1,
                        opacityTo: .6,
                        stops: [30, 70, 100]
                    }
                },
                stroke: {
                    dashArray: 5
                },
                grid: {
                    padding: {
                        top: -35,
                        bottom: -10
                    }
                },
                states: {
                    hover: {
                        filter: {
                            type: "none"
                        }
                    },
                    active: {
                        filter: {
                            type: "none"
                        }
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#growthChart"), options);
            chart.render();
        }

        function salesDetailsChart() {
            var options = {
                series: [{
                    name: "This Month",
                    type: "column",
                    data: [38, 45, 33, 38, 32, 50, 48, 40, 42, 37]
                }, {
                    name: "Previous Month",
                    type: "line",
                    data: [23, 28, 23, 32, 28, 44, 32, 38, 26, 34]
                }],
                chart: {
                    height: 320,
                    type: "line",
                    stacked: !1,
                    parentHeightOffset: 0,
                    toolbar: {
                        show: !1
                    },
                    zoom: {
                        enabled: !1
                    }
                },
                markers: {
                    size: 5,
                    colors: [config.colors.white],
                    strokeColors: config.colors.primary,
                    hover: {
                        size: 6
                    },
                    borderRadius: 4
                },
                stroke: {
                    curve: "smooth",
                    width: [0, 3],
                    lineCap: "round"
                },
                legend: {
                    show: !0,
                    position: "bottom",
                    markers: {
                        width: 8,
                        height: 8,
                        offsetX: -3
                    },
                    height: 40,
                    itemMargin: {
                        horizontal: 10,
                        vertical: 0
                    },
                    fontSize: "15px",
                    fontFamily: "Public Sans",
                    fontWeight: 400,
                    labels: {
                        colors: [config.colors.warning, config.colors.primary],
                        useSeriesColors: !1
                    },
                    offsetY: 10
                },
                grid: {
                    strokeDashArray: 8,
                    borderColor: config.colors.borderColor
                },
                colors: [config.colors.warning, config.colors.primary],
                fill: {
                    opacity: [1, 1]
                },
                plotOptions: {
                    bar: {
                        columnWidth: "30%",
                        startingShape: "rounded",
                        endingShape: "rounded",
                        borderRadius: 4
                    }
                },
                dataLabels: {
                    enabled: !1
                },
                xaxis: {
                    tickAmount: 10,
                    categories: ["1 Jan", "2 Jan", "3 Jan", "4 Jan", "5 Jan", "6 Jan", "7 Jan", "8 Jan", "9 Jan", "10 Jan"],
                    labels: {
                        style: {
                            colors: '#BBBFC4',
                            fontSize: "13px",
                            fontFamily: "Public Sans",
                            fontWeight: 400
                        }
                    },
                    axisBorder: {
                        show: !1
                    },
                    axisTicks: {
                        show: !1
                    }
                },
                yaxis: {
                    min: 0,
                    labels: {
                        style: {
                            colors: '#BBBFC4',
                            fontSize: "13px",
                            fontFamily: "Public Sans",
                            fontWeight: 400
                        },
                        formatter: function(e) {
                            return e
                        }
                    }
                },
                responsive: [{
                    breakpoint: 1400,
                    options: {
                        chart: {
                            height: 320
                        },
                        xaxis: {
                            labels: {
                                style: {
                                    fontSize: "10px"
                                }
                            }
                        },
                        legend: {
                            itemMargin: {
                                vertical: 0,
                                horizontal: 10
                            },
                            fontSize: "13px",
                            offsetY: 12
                        }
                    }
                }, {
                    breakpoint: 1025,
                    options: {
                        chart: {
                            height: 415
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: "50%"
                            }
                        }
                    }
                }, {
                    breakpoint: 982,
                    options: {
                        plotOptions: {
                            bar: {
                                columnWidth: "30%"
                            }
                        }
                    }
                }, {
                    breakpoint: 480,
                    options: {
                        chart: {
                            height: 250
                        },
                        legend: {
                            offsetY: 7
                        }
                    }
                }]
            };

            var chart = new ApexCharts(document.querySelector("#salesDetailsChart"), options);
            chart.render();
        }

        function earningChart() {
            var options = {
                chart: {
                    height: 120,
                    type: "bar",
                    toolbar: {
                        show: !1
                    }
                },
                plotOptions: {
                    bar: {
                        barHeight: "60%",
                        columnWidth: "50%",
                        startingShape: "rounded",
                        endingShape: "rounded",
                        borderRadius: 4,
                        distributed: !0
                    }
                },
                grid: {
                    show: !1,
                    padding: {
                        top: -35,
                        bottom: -10,
                        left: -10,
                        right: -10
                    }
                },
                colors: ['#E7E7FF', '#E7E7FF', '#E7E7FF', '#E7E7FF', config.colors.primary, '#E7E7FF', '#E7E7FF'],
                dataLabels: {
                    enabled: !1
                },
                series: [{
                    data: [40, 95, 60, 45, 90, 50, 75]
                }],
                legend: {
                    show: !1
                },
                xaxis: {
                    categories: ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
                    axisBorder: {
                        show: !1
                    },
                    axisTicks: {
                        show: !1
                    },
                    labels: {
                        style: {
                            colors: config.colors.primary,
                            fontSize: "13px"
                        }
                    }
                },
                yaxis: {
                    labels: {
                        show: !1
                    }
                }
            };

            var chart = new ApexCharts(document.querySelector("#earningChart"), options);
            chart.render();
        }

        profitChart()
        purchasesChart()
        salesChart()
        categoryAnalysisChart()
        topProductsChart()
        growthChart()
        salesStats()
        salesDetailsChart()
        earningChart()
    </script>
    <script>
        // Static Demo Data
        const salesData = {
            totalRevenue: 2500,
            totalTransactions: 50,
            averageSale: 50,
            salesByProduct: [
                { name: 'Milk', sku: 'SKU001', quantity: 30, revenue: 150 },
                { name: 'Bread', sku: 'SKU002', quantity: 20, revenue: 200 },
                { name: 'Cheese', sku: 'SKU003', quantity: 10, revenue: 300 },
            ],
            salesByCategory: [
                { category: 'Dairy', totalSales: 500 },
                { category: 'Bakery', totalSales: 300 },
            ],
            salesByPaymentMethod: [
                { method: 'Cash', totalSales: 1000 },
                { method: 'Credit Card', totalSales: 1500 },
            ],
            refunds: [
                { name: 'Bread', sku: 'SKU002', quantity: 2, refundAmount: 20, reason: 'Expired' },
            ]
        };

        function fetchSalesReport() {
            // Update Sales Overview
            $('#totalRevenue').text(`$${salesData.totalRevenue}`);
            $('#totalTransactions').text(salesData.totalTransactions);
            $('#averageSale').text(`$${salesData.averageSale}`);

            // Update Sales by Product
            $('#salesByProductBody').empty();
            salesData.salesByProduct.forEach(product => {
                $('#salesByProductBody').append(`
                <tr>
                    <td>${product.name}</td>
                    <td>${product.sku}</td>
                    <td>${product.quantity}</td>
                    <td>$${product.revenue}</td>
                </tr>
            `);
            });

            // Update Sales by Category
            $('#salesByCategoryBody').empty();
            salesData.salesByCategory.forEach(category => {
                $('#salesByCategoryBody').append(`
                <tr>
                    <td>${category.category}</td>
                    <td>$${category.totalSales}</td>
                </tr>
            `);
            });

            // Update Sales by Payment Method
            $('#salesByPaymentMethodBody').empty();
            salesData.salesByPaymentMethod.forEach(method => {
                $('#salesByPaymentMethodBody').append(`
                <tr>
                    <td>${method.method}</td>
                    <td>$${method.totalSales}</td>
                </tr>
            `);
            });

            // Update Refunds
            $('#refundsBody').empty();
            salesData.refunds.forEach(refund => {
                $('#refundsBody').append(`
                <tr>
                    <td>${refund.name}</td>
                    <td>${refund.sku}</td>
                    <td>${refund.quantity}</td>
                    <td>$${refund.refundAmount}</td>
                    <td>${refund.reason}</td>
                </tr>
            `);
            });
        }

        $(document).ready(function() {
            fetchSalesReport(); // Initial load with static demo data
        });
    </script>
@endpush
