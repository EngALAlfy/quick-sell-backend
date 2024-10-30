<div class="col-md-8">
    <div class="card h-100">
        <h5 class="card-header">{{ __('Transaction History') }}</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                <tr>
                    <th>{{ __('Product') }}</th>
                    <th>{{ __('Transaction Type') }}</th>
                    <th>{{ __('Quantity') }}</th>
                    <th>{{ __('Amount') }}</th>
                </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                @foreach($transactions as $transaction)
                    <tr>
                        <td>
                            <img src="{{ $transaction->product->getFirstMediaUrl('image') }}" alt="{{ $transaction->product->name }}" class="w-px-20 h-px-20">
                            <span>{{ $transaction->product->name }}</span>
                        </td>
                        <td>
                            <span class="badge {{ $badgeColors[$transaction->type] ?? 'bg-label-dark' }}">
                                {{ \App\Enums\TransactionType::from($transaction->type)->getName() }}
                            </span>
                        </td>
                        <td>{{ $transaction->quantity }}</td>
                        <td>${{ number_format($transaction->amount, 2) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
