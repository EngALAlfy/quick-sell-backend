<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("dashboard.suppliers.store")->open() !!}
        @include("dashboard.suppliers.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
