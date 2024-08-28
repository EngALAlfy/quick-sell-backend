<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($role , 'PUT')->acceptsFiles()->class("row g-3 fv-plugins-bootstrap5 fv-plugins-framework m-2")->route("admin.roles.update" , $role)->open() !!}
        @include("admin.roles.fields")
        {!! html()->closeModelForm() !!}
    </div>
</div>
