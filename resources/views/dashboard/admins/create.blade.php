<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("admin.admins.store")->open() !!}
        @include("admin.admins.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
