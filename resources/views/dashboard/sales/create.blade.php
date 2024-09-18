@extends("layouts.dashboard-full-width")

@section("title" , __('New Sale'))

@push("styles")
    <style>
        .nav-tabs {
            gap: 15px;
        }
        .order-summary {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
        }
        .product-card {
            text-align: center;
        }
        .product-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .order-table {
            width: 100%;
            border-collapse: collapse;
        }
        .order-table th, .order-table td {
            padding: 10px;
            text-align: left;
        }
        .total-section {
            background-color: #28a745;
            color: white;
            padding: 15px;
            border-radius: 10px;
        }
        .place-order-btn {
            border-radius: 10px;
            padding: 10px;
            font-size: 18px;
            text-align: center;
        }
        .compact-text {
            font-size: 14px;
            line-height: 1.2;
        }
        .product-price {
            font-size: 16px;
            font-weight: bold;
            color: #28a745;
        }

        /* Ensure table text breaks into new lines if too long */
        .table th, .table td {
            word-wrap: break-word;
            white-space: normal;
        }

        /* Optionally, you can set a min-height for the table rows for a consistent look */
        .table td {
            min-height: 50px; /* Adjust based on your design */
        }

        /* If needed, you can enforce horizontal scrolling on small screens */
        .table {
            table-layout: fixed; /* Ensures the table uses the specified column widths */
        }

        /* Customize each column width based on your layout */
        .table th, .table td {
            overflow: hidden; /* Prevents overflow of content outside of the table */
            text-overflow: ellipsis; /* Optionally truncate text with ellipsis */
        }
    </style>
@endpush
@section("content")
    @livewire("pos-page")
@endsection

@push('scripts')
@endpush
