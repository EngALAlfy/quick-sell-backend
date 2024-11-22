<div class="row gutters">
    <!-- Stock Details Section -->
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
            <tr>
                <td>@lang('ID')</td>
                <td>{{ $stock->id }}</td>
            </tr>
            <tr>
                <td>@lang('Product Name')</td>
                <td>{{ $stock->product->name }}</td>
            </tr>
            <tr>
                <td>@lang('Type')</td>
                <td>{{ $stock->transaction_type }}</td>
            </tr>
            <tr>
                <td>@lang('Quantity')</td>
                <td>{{ $stock->quantity }}</td>
            </tr>
            <tr>
                <td>@lang('Amount')</td>
                <td>{{ number_format($stock->amount, 2) }}</td>
            </tr>
            <tr>
                <td>@lang('Details')</td>
                <td>{{ $stock->details ?? __('No details available') }}</td>
            </tr>
            <tr>
                <td>@lang('Created At')</td>
                <td>{{ $stock->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
