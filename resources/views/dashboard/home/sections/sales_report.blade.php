<!-- Total Sales Report in this year -->
<div class="col-12 mb-5">
    <div class="card h-100">
        <div class="card-body">
            <div class="d-flex flex-column justify-content-between h-100">
                <div>
                    <div class="card-title mb-4">
                        <h5 class="text-nowrap mb-1">{{ __('Total Sales Report') }}</h5>
                        <span class="badge bg-label-warning">{{ __('YEAR') }} {{ $currentYear }}</span>
                    </div>
                    <div class="mt-auto">
                        <h4 class="mb-0">{{ \Illuminate\Support\Number::abbreviate($totalSales) }} {{__('EGP')}}</h4>
                    </div>
                </div>
                <div class="mt-4">
                    <canvas id="ReportChart" style="width: 100%; height: 200px;"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
