<div class="d-flex justify-content-start align-items-center user-name">
    <div class="avatar-wrapper">
        <div class="avatar avatar-sm me-4"><img src="{{$product->getFirstMediaUrl("image")}}" alt="{{$product->name}}"
                                                class="rounded-circle"></div>
    </div>
    <div class="d-flex flex-column"><a data-html-title="{{__("View product data")}}" href="{{route("dashboard.products.show" , $product->id)}}" class=" ajax-btn text-heading text-truncate"><span
                class="fw-medium">{{$product->name}}</span></a><small>{{$product->description}}</small></div>
</div>
