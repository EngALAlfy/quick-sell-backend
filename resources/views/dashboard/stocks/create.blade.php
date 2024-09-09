<div class="row gutters">
    <div class="col-12">
        {!! html()->form()->acceptsFiles()->route("dashboard.stocks.store")->open() !!}
        @include("dashboard.stocks.fields")
        {!! html()->form()->close() !!}
    </div>
</div>
