<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td>@lang('ID')</td>
                    <td>{{ $supplier->id }}</td>
                </tr>
                <tr>
                    <td>@lang('Name')</td>
                    <td>{{ $supplier->name }}</td>
                </tr>
                <tr>
                    <td>@lang('Contact Information')</td>
                    <td>{{ $supplier->contact_information }}</td>
                </tr>
                <tr>
                    <td>@lang('Created At')</td>
                    <td>{{ $supplier->created_at ? $supplier->created_at->format('Y-m-d H:i:s') : '-' }}</td>
                </tr>
                <tr>
                    <td>@lang('Last Update At')</td>
                    <td>{{ $supplier->updated_at ? $supplier->updated_at->format('Y-m-d H:i:s') : '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
