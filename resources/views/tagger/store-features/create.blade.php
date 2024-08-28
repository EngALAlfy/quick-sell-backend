<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("tagger.store-features.store")->open() !!}
        @include("tagger.store-features.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
