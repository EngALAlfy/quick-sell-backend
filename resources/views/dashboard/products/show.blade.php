<div class="row gutters">
    <div class="col-12 d-flex justify-content-center mb-4">
        <div class="avatar" style="width: 12rem;height: 12rem;">
            <img src="{{ $product->getFirstMediaUrl('image') }}" alt="{{ $product->name }}" class="rounded shadow">
        </div>
    </div>
    <div class="col-12">
        <table class="table table-bordered table-hover">
            <tbody>
                <tr>
                    <td width="30%">{{ __('ID') }}</td>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <td>{{ __('Name') }}</td>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <td>{{ __('Description') }}</td>
                    <td>{{ $product->description }}</td>
                </tr>
                <tr>
                    <td>{{ __('Purchase Price') }}</td>
                    <td>{{ $product->purchase_price }}</td>
                </tr>
                <tr>
                    <td>{{ __('Sell Price') }}</td>
                    <td>{{ $product->sell_price }}</td>
                </tr>
                <tr>
                    <td>{{ __('Stock Quantity') }}</td>
                    <td>{{ $product->stock_quantity }}</td>
                </tr>
                <tr>
                    <td>{{ __('SKU') }}</td>
                    <td>{{ $product->sku }}</td>
                </tr>
                <tr>
                    <td>{{ __('Category') }}</td>
                    <td>{{ optional($product->category)->name }}</td>
                </tr>
                <tr>
                    <td>{{ __('Created At') }}</td>
                    <td>{{ $product->created_at->format('Y-m-d H:i:s') }}</td>
                </tr>
                <tr>
                    <td>{{ __('Last Update At') }}</td>
                    <td>{{ $product->updated_at->format('Y-m-d H:i:s') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>