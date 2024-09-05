<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->class("row g-3 fv-plugins-bootstrap5 fv-plugins-framework m-2")->route("dashboard.permissions.store")->open() !!}
            @include("dashboard.permissions.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
