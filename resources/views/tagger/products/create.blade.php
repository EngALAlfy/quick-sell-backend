<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("tagger.products.store")->open() !!}
        @include("tagger.products.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
