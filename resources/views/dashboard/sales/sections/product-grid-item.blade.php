<div wire:click.prevent="addToOrder({{$product->id}})" class="col-md-3 cursor-pointer">
    <div class="card product-card">
        <img src="{{$product->getFirstMediaUrl("image")}}" class="card-img-top" alt="{{$product->name}}">
        <div class="card-body px-2 py-1">
            <h5 class="card-title compact-text">{{$product->name}}</h5>
            <p class="card-text text-muted compact-text mb-0">{{$product->description}}</p>
            <p class="product-price mb-0">{{$product->price}}</p>
        </div>
    </div>
</div>
