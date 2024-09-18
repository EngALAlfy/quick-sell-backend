<div class="row gutters">
    <div class="col-12">
        {!! html()->modelForm($client , 'PUT')->acceptsFiles()->route("dashboard.clients.update" , $client)->open() !!}
        @include("dashboard.clients.fields")
        {!! html()->closeModelForm() !!}

    </div>
</div>
