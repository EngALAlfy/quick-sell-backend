<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($tag, 'PUT')->acceptsFiles()->route('tagger.tags.update', $tag)->open() !!}
        @include('tagger.tags.fields')
        {!! html()->closeModelForm() !!}

    </div>
</div>
