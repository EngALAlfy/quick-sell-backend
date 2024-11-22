<div class="row gutters">
    <!-- Sale Details Section -->
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
            <tr>
                <td>@lang('ID')</td>
                <td>{{ $sale->id }}</td>
            </tr>
            <tr>
                <td>@lang('Product Name')</td>
                <td>{{ $sale->product->name ?? __('N/A') }}</td>
            </tr>
            <tr>
                <td>@lang('Category')</td>
                <td>{{ $sale->product->category->name ?? __('N/A') }}</td>
            </tr>
            <tr>
                <td>@lang('Quantity')</td>
                <td>{{ $sale->quantity }}</td>
            </tr>
            <tr>
                <td>@lang('Price per Unit')</td>
                <td>{{ number_format($sale->price_per_unit, 2) }}</td>
            </tr>
            <tr>
                <td>@lang('Total Amount')</td>
                <td>{{ number_format($sale->total_amount, 2) }}</td>
            </tr>
            <tr>
                <td>@lang('Sale Date')</td>
                <td>{{ $sale->created_at->format('Y-m-d H:i:s') }}</td>
            </tr>
            <tr>
                <td>@lang('Sold By')</td>
                <td>{{ $sale->user->name ?? __('N/A') }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
