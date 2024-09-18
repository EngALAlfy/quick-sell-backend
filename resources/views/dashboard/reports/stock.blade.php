@extends("layouts.dashboard")

@section("title" , __('Stock Report'))

@section("content")
    <div class="row gutters">
        <!-- Filters Section -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Stock Report') }}</h5>
                </div>
                <div class="card-body">
                    <form id="stockReportForm">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="categoryFilter">{{ __('Category') }}</label>
                                <select id="categoryFilter" class="form-select">
                                    <option value="all">{{ __('All Categories') }}</option>
                                    <option value="dairy">{{ __('Dairy') }}</option>
                                    <option value="bakery">{{ __('Bakery') }}</option>
                                    <!-- Add more categories as needed -->
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="stockStatusFilter">{{ __('Stock Status') }}</label>
                                <select id="stockStatusFilter" class="form-select">
                                    <option value="all">{{ __('All Statuses') }}</option>
                                    <option value="low">{{ __('Low Stock') }}</option>
                                    <option value="out">{{ __('Out of Stock') }}</option>
                                    <option value="adequate">{{ __('Adequate Stock') }}</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="productSearch">{{ __('Search Product') }}</label>
                                <input type="text" id="productSearch" class="form-control" placeholder="{{ __('Enter product name or SKU') }}">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="fetchStockData()">{{ __('Generate Report') }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Table for Stock Data -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ __('Stock Data') }}</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="stockTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('Product Name') }}</th>
                            <th>{{ __('SKU') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Current Stock') }}</th>
                            <th>{{ __('Minimum Stock') }}</th>
                            <th>{{ __('Stock Status') }}</th>
                        </tr>
                        </thead>
                        <tbody id="stockDataBody">
                        <!-- Stock data will be populated here via jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Summary Section -->
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5>{{ __('Stock Summary') }}</h5>
                    <p>{{ __('Total Products:') }} <span id="totalProducts">0</span></p>
                    <p>{{ __('Low Stock Products:') }} <span id="lowStockProducts">0</span></p>
                    <p>{{ __('Out of Stock Products:') }} <span id="outOfStockProducts">0</span></p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Static Demo Data
        const stockData = [
            { name: 'Milk', sku: 'SKU001', category: 'Dairy', currentStock: 5, minStock: 10, status: 'low' },
            { name: 'Bread', sku: 'SKU002', category: 'Bakery', currentStock: 0, minStock: 20, status: 'out' },
            { name: 'Cheese', sku: 'SKU003', category: 'Dairy', currentStock: 30, minStock: 15, status: 'adequate' },
            { name: 'Cake', sku: 'SKU004', category: 'Bakery', currentStock: 50, minStock: 10, status: 'adequate' },
        ];

        function fetchStockData() {
            // Clear previous data
            $('#stockDataBody').empty();

            let filteredData = stockData; // Add filtering logic here based on form inputs

            let totalProducts = 0;
            let lowStockProducts = 0;
            let outOfStockProducts = 0;

            // Append new data
            filteredData.forEach((product) => {
                $('#stockDataBody').append(`
                <tr>
                    <td>${product.name}</td>
                    <td>${product.sku}</td>
                    <td>${product.category}</td>
                    <td>${product.currentStock}</td>
                    <td>${product.minStock}</td>
                    <td>${product.status === 'low' ? '<span class="text-warning">Low</span>' : product.status === 'out' ? '<span class="text-danger">Out of Stock</span>' : '<span class="text-success">Adequate</span>'}</td>
                </tr>
            `);

                // Update summary counters
                totalProducts++;
                if (product.status === 'low') lowStockProducts++;
                if (product.status === 'out') outOfStockProducts++;
            });

            // Update Summary
            $('#totalProducts').text(totalProducts);
            $('#lowStockProducts').text(lowStockProducts);
            $('#outOfStockProducts').text(outOfStockProducts);
        }

        $(document).ready(function() {
            fetchStockData(); // Initial load
        });
    </script>
@endpush
