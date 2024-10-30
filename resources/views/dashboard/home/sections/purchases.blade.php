<!-- Total Purchases -->
<div class="col-6 mb-5">
    <div class="card h-100">
        <div class="card-body">
            <div class="card-title d-flex align-items-start justify-content-between mb-4">
                <div class="avatar flex-shrink-0">
                    <img src="{{ asset('assets/admin/sneat/img/icons/unicons/paypal.png') }}"
                         alt="{{ __('paypal') }}" class="rounded">
                </div>
            </div>
            <p class="mb-1">{{ __('Total Purchases') }}</p>
            <h4 class="card-title mb-3">${{ $totalPurchases }}</h4>
        </div>
    </div>
</div>
