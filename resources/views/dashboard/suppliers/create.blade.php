<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("dashboard.categories.store")->open() !!}
        @include("dashboard.categories.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
