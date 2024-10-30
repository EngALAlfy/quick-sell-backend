<!-- Total Sales -->
<div class="col-lg-4 col-md-4 order-1">
    <div class="row">
        <div class="col-lg-6 col-md-12 col-6 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/admin/sneat/img/icons/unicons/chart-success.png') }}"
                                 alt="{{ __('chart success') }}" class="rounded">
                        </div>
                    </div>
                    <p class="mb-1">{{ __('Total Sales') }}</p>
                    <h4 class="card-title mb-3">${{ $totalSales }}</h4>
                </div>
            </div>
        </div>
        <!-- Total Stock -->
        <div class="col-lg-6 col-md-12 col-6 mb-5">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title d-flex align-items-start justify-content-between mb-4">
                        <div class="avatar flex-shrink-0">
                            <img src="{{ asset('assets/admin/sneat/img/icons/unicons/wallet-info.png') }}"
                                 alt="{{ __('wallet info') }}" class="rounded">
                        </div>
                    </div>
                    <p class="mb-1">{{ __('Total Stock') }}</p>
                    <h4 class="card-title mb-3">${{ $totalStock }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>
