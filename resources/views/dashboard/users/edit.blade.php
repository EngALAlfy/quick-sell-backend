<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($user , 'PUT')->acceptsFiles()->route("dashboard.users.update" , $user)->open() !!}
        @include("dashboard.users.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
