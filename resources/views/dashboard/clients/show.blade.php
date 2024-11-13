<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td>@lang('ID')</td>
                    <td>{!! $client->id !!}</td>
                </tr>
                <tr>
                    <td>@lang('Name')</td>
                    <td>{!! $client->name !!}</td>
                </tr>
                <tr>
                    <td>@lang('Contact Information')</td>
                    <td>{!! $client->contact_information !!}</td>
                </tr>
                <tr>
                    <td>@lang('Created At')</td>
                    <td>{!! $client->created_at ? $client->created_at->format('Y-m-d H:i:s') : '-' !!}</td>
                </tr>
                <tr>
                    <td>@lang('Last Update At')</td>
                    <td>{!! $client->updated_at ? $client->updated_at->format('Y-m-d H:i:s') : '-' !!}</td>
                </tr>
            </tbody>
        </table>
    </div>
