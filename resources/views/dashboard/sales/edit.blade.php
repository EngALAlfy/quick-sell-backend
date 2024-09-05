<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($admin , 'PUT')->acceptsFiles()->route("dashboard.sales.update" , $admin)->open() !!}
        @include("dashboard.sales.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
