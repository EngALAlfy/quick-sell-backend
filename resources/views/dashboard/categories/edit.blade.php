<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($category , 'PUT')->acceptsFiles()->route("dashboard.categories.update" , $category)->open() !!}
        @include("dashboard.categories.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
