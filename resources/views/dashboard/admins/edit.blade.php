<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($admin , 'PUT')->acceptsFiles()->route("admin.admins.update" , $admin)->open() !!}
        @include("admin.admins.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
