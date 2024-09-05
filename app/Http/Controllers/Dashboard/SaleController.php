<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\SaleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index(SaleDataTable $dataTable)
    {
        return $dataTable->render('dashboard.sales.index');
    }

    public function show(Request $request, Sale $sale)
    {
        return view('dashboard.sales.show', compact('sale'));
    }

    public function create(Request $request)
    {
        $categories = Category::get();
        $products = Product::get();
        return view('dashboard.sales.create', compact("categories", "products"));
    }
}
