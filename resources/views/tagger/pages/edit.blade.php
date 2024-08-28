<div class="row gutters">
    <div class="col-12">
                {!! html()->modelForm($page , 'PUT')->acceptsFiles()->route("tagger.pages.update" , $page)->open() !!}
                @include("tagger.pages.fields")
                {!! html()->closeModelForm() !!}
    </div>
</div>

