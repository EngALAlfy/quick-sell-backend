<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\SaleDataTable;
use App\Enums\StockType;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(SaleDataTable $dataTable)
    {
        return $dataTable->render('dashboard.sales.index');
    }

    public function show(Request $request, Sale $sale)
    {
        $sale->load(['product.category', 'user']);
        return view('dashboard.sales.show', compact('sale'));
    }

    public function create(Request $request)
    {
        return view('dashboard.sales.create');
    }
}
