
@push("styles")
<link rel="stylesheet" href="{{asset("assets/admin/sneat/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css")}}" />
@endpush
<div>
    <div class="row gutters">
        <!-- Filters Section -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="align-items-center justify-content-between row">
                        <div class="col-7">
                            <div class="row">
                                <div class="col-5 d-flex align-items-center">
                                    <span class="me-3">
                                        <i class='bx bxs-calendar'></i>
                                    </span>
                                    <select name="reportType" id="reportType" class=" form-select" wire:model.live="reportType">
                                        <option value="yesterday">{{ __('Yesterday') }}</option>
                                        <option value="week">{{ __('This Week') }}</option>
                                        <option value="month">{{ __('This Month') }}</option>
                                        <option value="year">{{ __('This Year') }}</option>
                                        {{-- <option value="custom"> {{ __('Custom Range') }} </option> --}}
                                    </select>
                                </div>
                                <div class="col">
                                    <div class="input-group input-daterange" id="bs-datepicker-daterange">
                                        <input type="text" id="dateRangeStart" placeholder="DD/MM/YYYY" class="form-control" @if($reportType != 'custom') disabled @endif>
                                        <span class="input-group-text">to</span>
                                        <input type="text" id="dateRangeEnd" placeholder="DD/MM/YYYY" class="form-control" @if($reportType != 'custom') disabled @endif>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-2 text-end">
                            <button type="button" class="btn btn-primary" wire:click="generateReport" wire:loading.attr="disabled">
                                <span wire:loading.remove>{{ __('Generate Report') }}</span>
                                <span wire:loading >
                                    <div class="spinner-border spinner-border-sm" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <span>
                                        Updateing
                                    </span>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-xxl-4 col-md-4 col-4 mb-6">
            <div class="card" style="min-height: 100%;">
                <div class="card-body">
                    <div class="align-items-center d-flex flex-column flex-sm-row gap-4 justify-content-between" style="position: relative;">
                    <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                        <div class="card-title mb-6">
                        <h5 class="text-nowrap mb-1">Sales</h5>
                        <span class="badge bg-label-dark">Total: {{$this->data['salesCard']['count']}}</span>
                        </div>
                        <div class="mt-sm-auto">
                            <span @class([
                                'text-success' => $this->data['salesCard']['diff']['state'] == 'increasing',
                                'text-danger' => $this->data['salesCard']['diff']['state'] == 'decreasing',
                                'text-warning' => $this->data['salesCard']['diff']['state'] == 'no_change',
                                'text-nowrap fw-medium'
                            ])>
                                <i @class([
                                    'bx',
                                    'bx-up-arrow-alt' => $this->data['salesCard']['diff']['state'] == 'increasing',
                                    'down-arrow-alt' => $this->data['salesCard']['diff']['state'] == 'decreasing',
                                    'minus' => $this->data['salesCard']['diff']['state'] == 'no_change',
                                ])></i>
                                 {{$this->data['salesCard']['diff']['value']}} %
                            </span>
                            <div class="d-flex align-items-end">
                                <h4 class="mb-0" id="salesCardTotal">{{$this->data['salesCard']['total']}}</h4>
                                <small class="ms-1">EGP</small>
                            </div>
                        </div>
                    </div>
                    <div id="salesChart" wire:ignore></div>
                    <div class="resize-triggers"><div class="expand-trigger"><div style="width: 338px; height: 140px;"></div></div><div class="contract-trigger"></div></div></div>
                </div>
            </div>
        </div>
        <div class="col-xxl-2 col-md-2 col-2 mb-6">
            <div class="card h-100">
              <div class="card-body pb-0">
                <span class="d-block fw-medium mb-1">Purchases</span>
                <h4 class="card-title mb-0">{{$this->data['purchaseCard']['total']}} EGP</h4>
              </div>
              <div id="purchasesChart"  wire:ignore></div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 181px; height: 199px;"></div></div><div class="contract-trigger"></div></div></div>
        </div>
        <div class="col-xxl-2 col-md-2 col-2 mb-6">
            <div class="card h-100">
              <div class="card-body pb-0">
                <span class="d-block fw-medium mb-1">Profit</span>
                <h4 class="card-title mb-0">{{$this->data['profitCard']['total']}} EGP</h4>
              </div>
              <div id="profitChart" wire:ignore></div>
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
                <h4 class="card-title mb-0">{{$this->data['transactionsCard']['total']}} EGP</h4>
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
                    <div id="top-products-chart" wire:ignore></div>
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
                    <div id="category-analysis-chart" wire:ignore></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-4 col-xl-4 col-md-4">
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
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between">
                                <div class="me-2">
                                    <h6 class="mb-0">Net Profit</h6>
                                    <small class="text-muted">Profit after expenses</small>
                                </div>
                                <div class="">
                                    <span class="me-1">{{$data['earning']['profit']}} EGP</span>
                                    <span class="text-nowrap">
                                        <i @class([
                                            'bx ms-1',
                                            'bx-chevron-up text-success' => $this->data['earning']['diffProfitPercentage']['state'] == 'increasing',
                                            'bx-chevron-down text-danger' => $this->data['earning']['diffProfitPercentage']['state'] == 'decreasing',
                                            'minus text-warning' => $this->data['earning']['diffProfitPercentage']['state'] == 'no_change',
                                        ])></i>
                                        {{$this->data['earning']['diffProfitPercentage']['value']}} %
                                    </span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-3 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-success">
                                    <i class="bx bx-dollar"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between">
                                <div class="me-2">
                                    <h6 class="mb-0">Total Income</h6>
                                    <small class="text-muted">{{$data['earning']['count']}} Sales</small>
                                </div>
                                <div class="">
                                    <span class="me-1">{{$data['earning']['totalSales']}} EGP</span>
                                    <span class="text-nowrap">
                                        <i @class([
                                            'bx ms-1',
                                            'bx-chevron-up text-success' => $this->data['earning']['diffSalesPercentage']['state'] == 'increasing',
                                            'bx-chevron-down text-danger' => $this->data['earning']['diffSalesPercentage']['state'] == 'decreasing',
                                            'minus text-warning' => $this->data['earning']['diffSalesPercentage']['state'] == 'no_change',
                                        ])></i>
                                        {{$this->data['earning']['diffSalesPercentage']['value']}} %
                                    </span>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex mb-3 pb-1">
                            <div class="avatar flex-shrink-0 me-3">
                                <span class="avatar-initial rounded bg-label-secondary">
                                    <i class="bx bx-credit-card"></i>
                                </span>
                            </div>
                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between">
                                <div class="me-2">
                                    <h6 class="mb-0">Total Expenses</h6>
                                    <small class="text-muted">Your Purchases</small>
                                </div>
                                <div class="">
                                    <span class="me-1">{{$data['earning']['totalPurchase']}} EGP</span>
                                    <span class="text-nowrap">
                                        <i @class([
                                            'bx ms-1',
                                            'bx-chevron-up text-success' => $this->data['earning']['diffPurchasePercentage']['state'] == 'increasing',
                                            'bx-chevron-down text-danger' => $this->data['earning']['diffPurchasePercentage']['state'] == 'decreasing',
                                            'minus text-warning' => $this->data['earning']['diffPurchasePercentage']['state'] == 'no_change',
                                        ])></i>
                                        {{$this->data['earning']['diffPurchasePercentage']['value']}} %
                                    </span>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-3 col-xl-3 col-md-3">
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
                        <div class="badge bg-label-secondary">{{$this->data['paymentMethods']['cash']['value']}} EGP</div>
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
                        <div class="badge bg-label-secondary">{{$this->data['paymentMethods']['card']['value']}} EGP</div>
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
                        <div class="badge bg-label-secondary">{{$this->data['paymentMethods']['wallet']['value']}} EGP</div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
        </div>
        <div class="col-5 col-xl-5 col-md-5">
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
                                <h3 class="mb-1">--</h3>
                                <small>Total Clients</small>
                            </div>
                            <div class=" me-1 mt-2">
                                @if($this->data['clientStats']['growth']['state'] === "increasing")
                                    <span class="badge bg-label-success me-1">+{{$this->data['clientStats']['new']}} New client </span>This {{$this->data['clientStats']['period']}}
                                @else
                                    <span class="badge bg-label-warning me-1">No New client </span>This {{$this->data['clientStats']['period']}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card-body pt-lg-6">
                            <div id="growthChart" wire:ignore></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-12">
            <div class="card h-100">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="card-title mb-0">
                        <div class="align-items-center card-title d-flex mb-0">
                            <i class="fa-chart-simple fa-solid me-2 text-black-50"></i>
                            <h5 class="mb-1">Sales Report</h5>
                        </div>
                        <p class="mt-2 card-subtitle">
                            Total number of sales {{$this->data['salesCard']['count']}} <strong>({{$this->data['salesCard']['total']}} EGP)</strong>
                            <span @class([
                                'text-success' => $this->data['salesCard']['diff']['state'] == 'increasing',
                                'text-danger' => $this->data['salesCard']['diff']['state'] == 'decreasing',
                                'text-warning' => $this->data['salesCard']['diff']['state'] == 'no_change',
                                'text-nowrap fw-medium'
                            ])>
                                <i @class([
                                    'bx',
                                    'bx-up-arrow-alt' => $this->data['salesCard']['diff']['state'] == 'increasing',
                                    'down-arrow-alt' => $this->data['salesCard']['diff']['state'] == 'decreasing',
                                    'minus' => $this->data['salesCard']['diff']['state'] == 'no_change',
                                ])></i>
                                 {{$this->data['salesCard']['diff']['value']}} %
                            </span>
                        </p>
                    </div>
                </div>
                <div class="card-body" style="position: relative;">
                    <div id="salesDetailsChart" wire:ignore></div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script src="{{asset("assets/admin/sneat/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js")}}"></script>
    <script>

        let salesChartElement = null;
        let purchasesChartElement = null;
        let profitChartElement = null;
        let topProductsChartElement = null;
        let categoryChartElement = null;
        let growthChartElement = null;
        let salesDetailsChartElement = null;

        $("#dateRangeStart").datepicker({
            todayHighlight: true,
            format: "dd/mm/yyyy",
            orientation: "auto right"
        });
        $("#dateRangeEnd").datepicker({
            todayHighlight: true,
            format: "dd/mm/yyyy",
            orientation: "auto right"
        });

        Livewire.on('updateDateRange', (values) => {
            if (values.startRange) {
                $("#dateRangeStart").val(values.startRange).datepicker('update');
            }
            if (values.endRange) {
                $("#dateRangeEnd").val(values.endRange).datepicker('update');
            }
        });

        Livewire.on('updateData', (data) => {
            salesChart(data.data['salesCard']['chartData']);
            purchasesChart(data.data['purchaseCard']['chartData']);
            profitChart(data.data['profitCard']['chartData']);
            topProductsChart(data.data['topProducts']['chartData'], data.data['topProducts']['chartLegend']);
            categoryAnalysisChart(data.data['categoryAnalysis']['chartData'], data.data['categoryAnalysis']['chartLabels']);
            if(data.data['clientStats']['growth']['state'] === "increasing"){
                growthChart(data.data['clientStats']['growth']['value'], "Growth", config.colors.primary)
            }
            else if(data.data['clientStats']['growth']['state'] === "decreasing") {
                growthChart(data.data['clientStats']['growth']['value'], "Decreasing", config.colors.danger)
            }
            else {
                growthChart(data.data['clientStats']['growth']['value'], "Growth", config.colors.warning)
            }
            console.log(data.data['salesGraph']['chartDataCurrent'], data.data['salesGraph']['chartDataPrevious'], data.data['salesGraph']['x-axis'], data.data['salesGraph']['period']);

            salesDetailsChart(data.data['salesGraph']['chartDataCurrent'], data.data['salesGraph']['chartDataPrevious'], data.data['salesGraph']['x-axis'], data.data['salesGraph']['period']);
        });





        function salesChart(data) {
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
                    data: data
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

            if($("#salesChart").children().length > 0)
            {
                salesChartElement.updateSeries([{
                    data: data
                }])
            }
            else
            {
                salesChartElement = new ApexCharts(document.querySelector("#salesChart"), options);
                salesChartElement.render();
            }
        }

        function purchasesChart(data) {
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
                    data: data
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

            if($("#purchasesChart").children().length > 0)
            {
                purchasesChartElement.updateSeries([{
                    data: data
                }])
            }
            else
            {
                purchasesChartElement = new ApexCharts(document.querySelector("#purchasesChart"), options);
                purchasesChartElement.render();
            }
        }

        function profitChart(data) {
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
                    data: data
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
            if($("#profitChart").children().length > 0)
            {
                profitChartElement.updateSeries([{
                    data: data
                }])
            }
            else
            {
                profitChartElement = new ApexCharts(document.querySelector("#profitChart"), options);
                profitChartElement.render();
            }
        }

        function topProductsChart(data, chartLegend) {
            var options = {
                series: data,
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
                            return `${val} EGP`
                        }
                        return val
                    }
                },
                legend: {
                    show: true,
                    showForSingleSeries: true,
                    customLegendItems: chartLegend,
                    markers: {
                        fillColors: ['#00E396', '#775DD0']
                    }
                }
            };

            if($("#top-products-chart").children().length > 0)
            {
                topProductsChartElement.updateSeries(data);
                topProductsChartElement.updateOptions({
                    legend: {
                        customLegendItems: chartLegend
                    }
                });
            }
            else
            {
                topProductsChartElement = new ApexCharts(document.querySelector("#top-products-chart"), options);
                topProductsChartElement.render();
            }
        }

        function categoryAnalysisChart(data, labels) {
            var seriesData = data;
            var total = seriesData.reduce((a, b) => a + b, 0); // Sum of all series values

            var options = {
                series: seriesData,
                chart: {
                    width: 520,
                    type: 'polarArea'
                },
                labels: labels,
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
                        return seriesName + ' (' + opts.w.globals.series[opts.seriesIndex] + '%)';
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

            if($("#category-analysis-chart").children().length > 0)
            {
                categoryChartElement.updateSeries(seriesData);
                categoryChartElement.updateOptions({
                    labels: labels
                });
            }
            else
            {
                categoryChartElement = new ApexCharts(document.querySelector("#category-analysis-chart"), options);
                categoryChartElement.render();
            }
        }

        // function salesStats() {
        //     var options = {
        //         chart: {
        //             height: 190,
        //             type: "radialBar"
        //         },
        //         series: [75],
        //         labels: ["Sales"],
        //         plotOptions: {
        //             radialBar: {
        //                 startAngle: 0,
        //                 endAngle: 360,
        //                 strokeWidth: "70",
        //                 hollow: {
        //                     margin: 50,
        //                     size: "75%",
        //                     imageWidth: 65,
        //                     imageHeight: 55,
        //                     imageOffsetY: -35,
        //                     imageClipped: !1
        //                 },

        //                 track: {
        //                     strokeWidth: "50%",
        //                     background: '#E8EAEB'
        //                 },
        //                 dataLabels: {
        //                     show: !0,
        //                     name: {
        //                         offsetY: 60,
        //                         show: !1,
        //                         color: config.colors.success,
        //                         fontSize: "15px",
        //                         fontFamily: "Public Sans"
        //                     },
        //                     value: {
        //                         formatter: function(o) {
        //                             return parseInt(o) + "%"
        //                         },
        //                         offsetY: 10,
        //                         color: config.colors.success,
        //                         fontSize: "28px",
        //                         fontWeight: "500",
        //                         fontFamily: "Public Sans",
        //                         show: !0
        //                     }
        //                 }
        //             }
        //         },
        //         fill: {
        //             type: "solid",
        //             colors: config.colors.success
        //         },
        //         stroke: {
        //             lineCap: "round"
        //         },
        //         states: {
        //             hover: {
        //                 filter: {
        //                     type: "none"
        //                 }
        //             },
        //             active: {
        //                 filter: {
        //                     type: "none"
        //                 }
        //             }
        //         }
        //     };

        //     var chart = new ApexCharts(document.querySelector("#salesStats"), options);
        //     chart.render();
        // }

        function growthChart(data, label, mycolor) {
            var options = {
                series: [data],
                labels: [label],
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
                                color: mycolor,
                                fontSize: "15px",
                                fontWeight: "500",
                                fontFamily: "Public Sans"
                            },
                            value: {
                                offsetY: -25,
                                color: mycolor,
                                fontSize: "22px",
                                fontWeight: "500",
                                fontFamily: "Public Sans"
                            }
                        }
                    }
                },
                colors: [mycolor],
                fill: {
                    type: "gradient",
                    gradient: {
                        shade: "dark",
                        shadeIntensity: .5,
                        gradientToColors: [mycolor],
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

            if($("#growthChart").children().length > 0)
            {
                growthChartElement.updateSeries([data]);

                growthChartElement.updateOptions({
                    labels: [label],
                    plotOptions: {
                        radialBar: {
                            dataLabels: {
                                name: {
                                    color: mycolor
                                },
                                value: {
                                    color: mycolor
                                }
                            }
                        }
                    },
                    colors: [mycolor],
                    fill: {
                        gradient: {
                            gradientToColors: [mycolor]
                        }
                    }
                });
            }
            else
            {
                growthChartElement = new ApexCharts(document.querySelector("#growthChart"), options);
                growthChartElement.render();
            }
        }

        function salesDetailsChart(data1, data2, labels, period) {
            var options = {
                series: [{
                    name: `This ${period}`,
                    type: "column",
                    data: data1
                }, {
                    name: `Previous ${period}`,
                    type: "line",
                    data: data2
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
                    categories: labels,
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

            salesDetailsChartElement = new ApexCharts(document.querySelector("#salesDetailsChart"), options);
            salesDetailsChartElement.render();
            salesDetailsChartElement.destroy();
            salesDetailsChartElement = new ApexCharts(document.querySelector("#salesDetailsChart"), options);
            salesDetailsChartElement.render();
        }

        // function earningChart() {
        //     var options = {
        //         chart: {
        //             height: 120,
        //             type: "bar",
        //             toolbar: {
        //                 show: !1
        //             }
        //         },
        //         plotOptions: {
        //             bar: {
        //                 barHeight: "60%",
        //                 columnWidth: "50%",
        //                 startingShape: "rounded",
        //                 endingShape: "rounded",
        //                 borderRadius: 4,
        //                 distributed: !0
        //             }
        //         },
        //         grid: {
        //             show: !1,
        //             padding: {
        //                 top: -35,
        //                 bottom: -10,
        //                 left: -10,
        //                 right: -10
        //             }
        //         },
        //         colors: ['#E7E7FF', '#E7E7FF', '#E7E7FF', '#E7E7FF', config.colors.primary, '#E7E7FF', '#E7E7FF'],
        //         dataLabels: {
        //             enabled: !1
        //         },
        //         series: [{
        //             data: [40, 95, 60, 45, 90, 50, 75]
        //         }],
        //         legend: {
        //             show: !1
        //         },
        //         xaxis: {
        //             categories: ["Mo", "Tu", "We", "Th", "Fr", "Sa", "Su"],
        //             axisBorder: {
        //                 show: !1
        //             },
        //             axisTicks: {
        //                 show: !1
        //             },
        //             labels: {
        //                 style: {
        //                     colors: config.colors.primary,
        //                     fontSize: "13px"
        //                 }
        //             }
        //         },
        //         yaxis: {
        //             labels: {
        //                 show: !1
        //             }
        //         }
        //     };

        //     var chart = new ApexCharts(document.querySelector("#earningChart"), options);
        //     chart.render();
        // }

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
