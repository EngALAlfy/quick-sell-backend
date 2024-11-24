<div class="row gutters">
    <div class="col-12">
        <table class="table table-bordered table-hover table-responsive">
            <tbody>
            <tr>
                <td>@lang('ID')</td>
                <td>{!! $transaction->id !!}</td>
            </tr>
            <tr>
                <td>@lang('Type')</td>
                <td>{!! $transaction->type !!}</td>
            </tr>
            <tr>
                <td>@lang('Created By')</td>
                <td>{!! $transaction->created_by !!}</td>
            </tr>
            <tr>
                <td>@lang('Quantity')</td>
                <td>{!! $transaction->quantity !!}</td>
            </tr>
            <tr>
                <td>@lang('Amount')</td>
                <td>{!! $transaction->amount !!}</td>
            </tr>
            <tr>
                <td>@lang('Details')</td>
                <td>{!! $transaction->details !!}</td>
            </tr>
            <tr>
                <td>@lang('Created At')</td>
                <td>{!! $transaction->created_at ? $transaction->created_at->format('Y-m-d H:i:s') : '-' !!}</td>
            </tr>
            </tbody>
        </table>
    </div>
    {{-- Add a button for additional actions --}}
    <div class="col-12 mt-3">
        <a href="{{ route('dashboard.transactions.index') }}" class="btn btn-secondary">
            <i class="fa fa-arrow-left me-2"></i>{{ __('Back to Transactions') }}
        </a>
    </div>
</div>
