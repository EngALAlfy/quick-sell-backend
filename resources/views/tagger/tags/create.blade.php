<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("tagger.tags.store")->open() !!}
        @include("tagger.tags.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
