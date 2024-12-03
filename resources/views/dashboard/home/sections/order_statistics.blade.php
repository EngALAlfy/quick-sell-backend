<div class="col-md-4">
    <div class="card h-100">
        <div class="card-header">
            <h5 class="card-title">{{ __('Order Statistics') }}</h5>
            <p class="card-subtitle">{{ __('Total Sales') }} {{ \Illuminate\Support\Number::abbreviate($totalSales) }} {{__('EGP')}}</p>
        </div>
        <div class="card-body pt-4">
            <canvas id="topProductChartCanvas" style="max-width: 300px;"></canvas>
            <ul class="p-0 m-0">
                @foreach($topProducts as $product)
                    <li class="d-flex align-items-center mb-5">
                        <div class="avatar flex-shrink-0 me-3">
                            <span class="avatar-initial rounded bg-label-primary"><i class='bx bx-box'></i></span>
                        </div>
                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                            <div class="me-2">
                                <h6 class="mb-0">{{ $product['product']->name }}</h6>
                                <small>{{ __('Sold:') }} {{ \Illuminate\Support\Number::abbreviate($product['total_quantity']) }}</small>
                            </div>
                            <div class="user-progress">
                                <h6 class="mb-0">{{ \Illuminate\Support\Number::abbreviate($product['total_quantity']) }}</h6>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
