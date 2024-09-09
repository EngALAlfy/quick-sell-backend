<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($product , 'PUT')->acceptsFiles()->route("dashboard.products.update" , $product)->open() !!}
        @include("dashboard.products.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
