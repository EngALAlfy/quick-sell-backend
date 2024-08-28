<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("tagger.categories.store")->open() !!}
        @include("tagger.categories.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
