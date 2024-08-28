<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($category , 'PUT')->acceptsFiles()->route("tagger.categories.update" , $category)->open() !!}
        @include("tagger.categories.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
