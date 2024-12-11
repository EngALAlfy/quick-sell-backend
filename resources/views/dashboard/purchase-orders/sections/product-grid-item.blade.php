<div wire:click.prevent="addToOrder({{$product->id}})" class="col-md-3 cursor-pointer">
    <div class="card product-card mb-3">
        <img src="{{$product->getFirstMediaUrl("image")}}" class="card-img-top" alt="{{$product->name}}">
        <div class="card-body px-2 py-1">
            <h5 class="card-title compact-text" style="margin-bottom: 5px">{{$product->name}} @if($product->enable_stock) ({{$product->stock_quantity}}) @endif</h5>
            <p class="card-text text-muted compact-text mb-0">({{$product->sku}})</p>
            <p class="card-text text-muted compact-text mb-0" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">{{$product->description}}</p>
            <p class="product-price mb-0">{{$product->purchase_price}}</p>
        </div>
    </div>
</div>
