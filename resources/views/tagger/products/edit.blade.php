<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($product , 'PUT')->acceptsFiles()->route("tagger.products.update" , $product)->open() !!}
        @include("tagger.products.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
