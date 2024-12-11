<div class="col-md-6  position-relative">
    <!-- Search Bar with SKU and Product Name -->
    <div class="input-group input-group-merge mb-3 shadow-sm">
        <span class="input-group-text bg-light" id="basic-addon-search31">
            <i class="bx bx-barcode-reader"></i> <!-- Barcode Icon -->
        </span>
        <input type="text" class="form-control" placeholder="Enter SKU or Product Name"
               aria-label="Search by SKU or Product Name"
               aria-describedby="basic-addon-search31"
               wire:model.lazy="searchTerm"
               wire:keydown="fetchProducts"
               wire:keydown.enter="addProductBySearch()"
               autofocus/>
        <button class="btn btn-primary" wire:click="addProductBySearch()">
            <i class="bx bx-search me-2"></i>
            {{ __('Add Product') }}
        </button>
    </div>

    <!-- Dropdown for displaying products -->
    @if($searchResults->isNotEmpty())
        <div class="dropdown-menu show" style="width:97%;max-height: 250px; overflow-y: auto;">
            @foreach($searchResults as $result)
                <a href="#" class="dropdown-item" wire:click.prevent="selectProduct({{ $result->id }})">
                    {{ $result->name }} (SKU: {{ $result->sku }}) - {{ $result->sell_price }} {{__('EGP')}}
                </a>
            @endforeach
        </div>
    @endif

    <!-- Order Summary Section -->
    <div class="order-summary">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>{{ __('Current Order') }}</h5>
            <button class="btn btn-light" wire:click.prevent="clearOrder()">{{ __('Clear All') }}</button>
        </div>

        <!-- Order Table -->
        <table class="table order-table table-sm table-striped">
            <thead>
            <tr>
                <th style="width: 35%;">{{ __('Item') }}</th>
                <th style="width: 20%;" class="text-center">{{ __('Qty') }}</th>
                <th style="width: 18%;">{{ __('Price') }}</th>
                <th style="width: 18%;">{{ __('Total') }}</th>
                <th style="width: 9%;"></th>
            </tr>
            </thead>
            <tbody>
            @forelse($orderItems as $item)
                @include("dashboard.purchase-orders.sections.order-item-row", compact("item"))
            @empty
                <tr>
                    <td colspan="5"><h6 class="text-center text-danger m-1">{{ __("No data added") }}</h6></td>
                </tr>
            @endforelse
            </tbody>
        </table>


        <!-- Total Section -->
        <div class="total-section mt-4">
            <div class="d-flex justify-content-between">
                <span>{{ __('Subtotal') }}</span>
                <span>{{$this->getTotal()}}</span>
            </div>
            <h4 class="text-end mt-3">{{ __('Total') }}: {{$this->getTotal()}}</h4>
        </div>

        <!-- Payment Method Section -->
        @include("dashboard.purchase-orders.sections.payment-method")

        @include("includes.select",
            [
            "name" => "client_id" ,
            "title" => __('Client') ,
            "placeholder" => __('Select permission group') ,
            "required" => true,
            "has_new_item" => true,
            "new_item_route" => route("dashboard.clients.create"),
            "floating" => false,
            "options" => $clients,
            "col" => "12",
            "classes" => "select2 mb-4 fv-plugins-icon-container",
          ])
        <!-- Place Order Button -->
        <button wire:click.prevent="placeOrder()" class="btn btn-label-dark place-order-btn w-100 mt-4">
            <div wire:loading wire:target="placeOrder" class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <span wire:loading.remove wire:target="placeOrder">{{ __('Place Order') }}</span>
        </button>
    </div>
</div>
