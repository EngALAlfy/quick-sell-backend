<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
            <tr>
                <td>@lang("ID")</td>
                <td>{!! $walletTransaction->id !!}</td>
            </tr>
            <tr>
                <td>@lang("Store")</td>
                <td>{!! $walletTransaction->store->name !!}</td>
            </tr>

            <tr>
                <td>@lang("Name")</td>
                <td>{!! $walletTransaction->name !!}</td>
            </tr>

            <tr>
                <td>@lang("Amount")</td>
                <td>{!! $walletTransaction->amount !!} EGP</td>
            </tr>

            <tr>
                <td>@lang("Note")</td>
                <td>{!! $walletTransaction->note !!}</td>
            </tr>

            <tr>
                <td>@lang("Options")</td>
                <td>
                    @if(!empty($walletTransaction->options))
                        <ul class="p-0 m-0">
                            @foreach ($walletTransaction->options as $key => $value)
                                <li class="text-capitalize list-group-item">{!! $key !!}: {!! $value !!}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
            </tr>

            <tr>
                <td>@lang("status")</td>
                <td class="text-capitalize">{!! $walletTransaction->status !!}</td>
            </tr>

            <tr>
                <td>@lang("Created At")</td>
                <td>{!! $walletTransaction->created_at !!}</td>
            </tr>

            <tr>
                <td>@lang("Last update At")</td>
                <td>{!! $walletTransaction->updated_at !!}</td>
            </tr>

            </tbody>
        </table>
    </div>
    {{--  todo:: add this   --}}
    <a href="#" class="btn btn-primary"><i class="fa fa-eye me-2"></i>{{__('View more details')}}</a>
</div>
