@extends("layouts.dashboard")

@section("title", __('Sales Report'))

@section("content")
    <div class="row gutters">
        <!-- Filters Section -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Sales Reports') }}</h5>
                </div>
                <div class="card-body">
                    <form id="salesReportForm">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="dateRange">{{ __('Date Range') }}</label>
                                <input type="date" id="startDate" class="form-control" placeholder="{{ __('Start Date') }}">
                                <input type="date" id="endDate" class="form-control mt-2" placeholder="{{ __('End Date') }}">
                            </div>
                            <div class="col-md-4">
                                <label for="filter">{{ __('Report Type') }}</label>
                                <select id="reportType" class="form-select">
                                    <option value="daily">{{ __('Daily') }}</option>
                                    <option value="weekly">{{ __('Weekly') }}</option>
                                    <option value="monthly">{{ __('Monthly') }}</option>
                                </select>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="fetchSalesReport()">{{ __('Generate Report') }}</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Daily/Weekly/Monthly Sales Report -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Sales Overview') }}</h5>
                </div>
                <div class="card-body">
                    <p>{{ __('Total Revenue:') }} <span id="totalRevenue">$0.00</span></p>
                    <p>{{ __('Number of Transactions:') }} <span id="totalTransactions">0</span></p>
                    <p>{{ __('Average Sale per Customer:') }} <span id="averageSale">$0.00</span></p>
                </div>
            </div>
        </div>

        <!-- Sales by Product -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Sales by Product') }}</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="salesByProductTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('Product Name') }}</th>
                            <th>{{ __('SKU') }}</th>
                            <th>{{ __('Quantity Sold') }}</th>
                            <th>{{ __('Total Revenue') }}</th>
                        </tr>
                        </thead>
                        <tbody id="salesByProductBody">
                        <!-- Sales data will be populated here via jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sales by Category -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Sales by Category') }}</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="salesByCategoryTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Total Sales') }}</th>
                        </tr>
                        </thead>
                        <tbody id="salesByCategoryBody">
                        <!-- Sales data will be populated here via jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Sales by Payment Method -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Sales by Payment Method') }}</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="salesByPaymentMethodTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('Payment Method') }}</th>
                            <th>{{ __('Total Sales') }}</th>
                        </tr>
                        </thead>
                        <tbody id="salesByPaymentMethodBody">
                        <!-- Sales data will be populated here via jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Refunds/Returns Report -->
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>{{ __('Refunds/Returns Report') }}</h5>
                </div>
                <div class="card-datatable table-responsive">
                    <table id="refundsTable" class="table table-striped">
                        <thead>
                        <tr>
                            <th>{{ __('Product Name') }}</th>
                            <th>{{ __('SKU') }}</th>
                            <th>{{ __('Quantity Returned') }}</th>
                            <th>{{ __('Refund Amount') }}</th>
                            <th>{{ __('Reason') }}</th>
                        </tr>
                        </thead>
                        <tbody id="refundsBody">
                        <!-- Refunds data will be populated here via jQuery -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Static Demo Data
        const salesData = {
            totalRevenue: 2500,
            totalTransactions: 50,
            averageSale: 50,
            salesByProduct: [
                { name: 'Milk', sku: 'SKU001', quantity: 30, revenue: 150 },
                { name: 'Bread', sku: 'SKU002', quantity: 20, revenue: 200 },
                { name: 'Cheese', sku: 'SKU003', quantity: 10, revenue: 300 },
            ],
            salesByCategory: [
                { category: 'Dairy', totalSales: 500 },
                { category: 'Bakery', totalSales: 300 },
            ],
            salesByPaymentMethod: [
                { method: 'Cash', totalSales: 1000 },
                { method: 'Credit Card', totalSales: 1500 },
            ],
            refunds: [
                { name: 'Bread', sku: 'SKU002', quantity: 2, refundAmount: 20, reason: 'Expired' },
            ]
        };

        function fetchSalesReport() {
            // Update Sales Overview
            $('#totalRevenue').text(`$${salesData.totalRevenue}`);
            $('#totalTransactions').text(salesData.totalTransactions);
            $('#averageSale').text(`$${salesData.averageSale}`);

            // Update Sales by Product
            $('#salesByProductBody').empty();
            salesData.salesByProduct.forEach(product => {
                $('#salesByProductBody').append(`
                <tr>
                    <td>${product.name}</td>
                    <td>${product.sku}</td>
                    <td>${product.quantity}</td>
                    <td>$${product.revenue}</td>
                </tr>
            `);
            });

            // Update Sales by Category
            $('#salesByCategoryBody').empty();
            salesData.salesByCategory.forEach(category => {
                $('#salesByCategoryBody').append(`
                <tr>
                    <td>${category.category}</td>
                    <td>$${category.totalSales}</td>
                </tr>
            `);
            });

            // Update Sales by Payment Method
            $('#salesByPaymentMethodBody').empty();
            salesData.salesByPaymentMethod.forEach(method => {
                $('#salesByPaymentMethodBody').append(`
                <tr>
                    <td>${method.method}</td>
                    <td>$${method.totalSales}</td>
                </tr>
            `);
            });

            // Update Refunds
            $('#refundsBody').empty();
            salesData.refunds.forEach(refund => {
                $('#refundsBody').append(`
                <tr>
                    <td>${refund.name}</td>
                    <td>${refund.sku}</td>
                    <td>${refund.quantity}</td>
                    <td>$${refund.refundAmount}</td>
                    <td>${refund.reason}</td>
                </tr>
            `);
            });
        }

        $(document).ready(function() {
            fetchSalesReport(); // Initial load with static demo data
        });
    </script>
@endpush
