<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td>@lang('ID')</td>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <td>@lang('Name')</td>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <td>@lang('Description')</td>
                    <td>{{ $category->description }}</td>
                </tr>
                <tr>
                    <td>@lang('Created At')</td>
                    <td>{{ $category->created_at ? $category->created_at->format('Y-m-d H:i:s') : '-' }}</td>
                </tr>
                <tr>
                    <td>@lang('Last Update At')</td>
                    <td>{{ $category->updated_at ? $category->updated_at->format('Y-m-d H:i:s') : '-' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
