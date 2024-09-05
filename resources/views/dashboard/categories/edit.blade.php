<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($admin , 'PUT')->acceptsFiles()->route("dashboard.categories.update" , $admin)->open() !!}
        @include("dashboard.categories.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
