<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("dashboard.clients.store")->open() !!}
        @include("dashboard.clients.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
