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
                    <td>@lang('Created By')</td>
                    <td>{{ $sale->created_by_user_id }}</td>
                </tr>
                <tr>
                    <td>@lang('Total Amount')</td>
                    <td>{{ number_format($sale->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <td>@lang('Payment Method')</td>
                    <td>{{ $sale->payment_method }}</td>
                </tr>
                <tr>
                    <td>@lang('Created At')</td>
                    <td>{{ $sale->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                <tr>
                    <td>@lang('Updated At')</td>
                    <td>{{ $sale->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
