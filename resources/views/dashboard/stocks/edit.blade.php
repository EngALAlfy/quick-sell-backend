<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($stock , 'PUT')->acceptsFiles()->route("dashboard.stocks.update" , $stock)->open() !!}
        @include("dashboard.stocks.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
