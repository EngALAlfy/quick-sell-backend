<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($user , 'PUT')->acceptsFiles()->route("dashboard.users.status.change" , $user)->open() !!}
        @include("dashboard.users.status_fields")
        {!! html()->closeModelForm() !!}
    </div>
</div>
