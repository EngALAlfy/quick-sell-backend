<div class="row gutters">
    <!-- Purchase Order Details Section -->
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
                <tr>
                    <td>@lang('ID')</td>
                    <td>{{ $purchaseOrder->id }}</td>
                </tr>
                <tr>
                    <td>@lang('Created By')</td>
                    <td>{{ $purchaseOrder->created_by_user_id }}</td>
                </tr>
                <tr>
                    <td>@lang('Total Amount')</td>
                    <td>{{ number_format($purchaseOrder->total_amount, 2) }}</td>
                </tr>
                <tr>
                    <td>@lang('Payment Method')</td>
                    <td>{{ $purchaseOrder->payment_method }}</td>
                </tr>
                <tr>
                    <td>@lang('Created At')</td>
                    <td>{{ $purchaseOrder->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                <tr>
                    <td>@lang('Updated At')</td>
                    <td>{{ $purchaseOrder->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
