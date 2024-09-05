<div class="col-md-6">
    <div class="input-group input-group-merge mb-3">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <input type="text" class="form-control" placeholder="Search..." aria-label="Search..." aria-describedby="basic-addon-search31">
    </div>

    <div class="order-summary">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>{{__('Current Order')}}</h5>
            <button class="btn btn-light" wire:click.prevent="clearOrder()">{{__('Clear All')}}</button>
        </div>

        <table class="order-table">
            <thead>
            <tr>
                <th>{{__('Item')}}</th>
                <th>{{__('Qty')}}</th>
                <th>{{__('Price')}}</th>
                <th>{{__('Total')}}</th>
            </tr>
            </thead>
            <tbody>
            @forelse($orderItems as $item)
                @include("dashboard.sales.sections.order-item-row" , compact("item"))
            @empty
                <tr><td colspan="4"><h6 class="text-center text-danger m-4">{{__("No data added")}}</h6></td></tr>
            @endforelse

            </tbody>
        </table>

        <div class="total-section mt-4">
            <div class="d-flex justify-content-between">
                <span>{{__('Subtotal')}}</span>
                <span>{{$this->getTotal()}}</span>
            </div>
            <h4 class="text-end mt-3">{{__('Total')}}: {{$this->getTotal()}}</h4>
        </div>

        @include("dashboard.sales.sections.payment-method")

        <button wire:click.prevent="placeOrder()" class="btn place-order-btn w-100 mt-4">
            <div wire:loading wire:target="placeOrder" class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <span wire:loading.remove wire:target="placeOrder" >{{__('Place Order')}}</span>
        </button>
    </div>
</div>
