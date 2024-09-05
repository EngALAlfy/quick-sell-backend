<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("dashboard.products.store")->open() !!}
        @include("dashboard.products.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
