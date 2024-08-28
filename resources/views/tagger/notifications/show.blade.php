<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
            <tr>
                <td>@lang("Title")</td>
                <td>{!! $notification->title !!}</td>
            </tr>
            <tr>
                <td>@lang("Description")</td>
                <td>{!! $notification->description !!}</td>
            </tr>


            <tr>
                <td>@lang("Store")</td>
                <td>
                    @if($notification->store_id)
                        {!! $notification->store->name !!}
                    @else
                        {{__("All Stores")}}
                    @endif
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
