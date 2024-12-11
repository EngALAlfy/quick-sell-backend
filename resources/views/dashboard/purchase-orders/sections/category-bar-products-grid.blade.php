<div class="row">
    @forelse($products as $product)
        @include("dashboard.purchase-orders.sections.product-grid-item" , ["product" => $product])
    @empty
          <h6 class="text-center text-danger">{{__("No data found")}}</h6>
    @endforelse
</div>
