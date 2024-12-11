<div class="col-md-6">
    <ul class="nav nav-tabs mb-4 pb-3 d-flex" id="menuTabs" role="tablist">
        @include("dashboard.purchase-orders.sections.category-bar-item")
        @foreach($categories as $category)
            @include("dashboard.purchase-orders.sections.category-bar-item" , compact("category"))
        @endforeach
    </ul>

    <!-- Product Grid -->
    @include("dashboard.purchase-orders.sections.category-bar-products-grid")
</div>
