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
            background-color: #007bff;
            color: white;
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
    </style>
@endpush
@section("content")
    @livewire("pos-page")
@endsection

@push('scripts')
@endpush
