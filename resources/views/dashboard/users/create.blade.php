<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("dashboard.users.store")->open() !!}
        @include("dashboard.users.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
