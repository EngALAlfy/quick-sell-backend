<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("tagger.pages.store")->open() !!}
        @include("tagger.pages.fields")
        {!! html()->form()->close() !!}
    </div>
</div>

