<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($admin , 'PUT')->acceptsFiles()->route("dashboard.products.update" , $admin)->open() !!}
        @include("dashboard.products.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
