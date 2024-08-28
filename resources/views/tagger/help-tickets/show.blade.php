<div class="row gutters">

    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td>@lang('ID')</td>
                    <td>{!! $helpTicket->id !!}</td>
                </tr>
                <tr>
                    <td>@lang('Subject')</td>
                    <td>{!! $helpTicket->subject !!}</td>
                </tr>

                <tr>
                    <td>@lang('Description')</td>
                    <td>{!! $helpTicket->description !!}</td>
                </tr>


                <tr>
                    <td>@lang('Tagger')</td>
                    <td>{!! $helpTicket->tagger->name !!}</td>
                </tr>

                <tr>
                    <td>@lang('Store')</td>
                    <td>{!! $helpTicket->store->name !!}</td>
                </tr>

                <tr>
                    <td>@lang('Status By')</td>
                    <td>{!! $helpTicket->statusByAdmin?->name !!}</td>
                </tr>

                <tr>
                    <td>@lang('Status Datetime')</td>
                    <td>{!! $helpTicket->status_datetime !!}</td>
                </tr>

                <tr>
                    <td>@lang('Status')</td>
                    <td>{!! $helpTicket->status !!}</td>
                </tr>

                <tr>
                    <td>@lang('Created At')</td>
                    <td>{!! $helpTicket->created_at !!}</td>
                </tr>

                <tr>
                    <td>@lang('Updated At')</td>
                    <td>{!! $helpTicket->updated_at !!}</td>
                </tr>

            </tbody>
        </table>
    </div>
    {{--  todo:: add this   --}}
    <a href="#" class="btn btn-primary"><i class="fa fa-eye me-2"></i>{{ __('View more details') }}</a>
</div>
