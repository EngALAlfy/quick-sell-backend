<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->class("row g-3 fv-plugins-bootstrap5 fv-plugins-framework m-2")->route("dashboard.permission-groups.store")->open() !!}
            @include("dashboard.permission-groups.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
