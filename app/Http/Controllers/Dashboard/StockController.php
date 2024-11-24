<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\StockDataTable;
use App\Enums\TransactionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockUpdateRequest;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class StockController extends Controller
{
    public function index(StockDataTable $dataTable)
    {
        return $dataTable->render('dashboard.stocks.index');
    }

    public function create(Request $request)
    {
        $products = Product::pluck('name', 'id');
        return view('dashboard.stocks.create', compact('products'));
    }

    public function store(StockUpdateRequest $request)
    {
        DB::transaction(function () use ($request) {
            $product = Product::find($request->get("product_id"));
            $product->transactions()->create([
                "quantity" => $request->quantity,
                "amount" => 0,
                "type" => TransactionType::adjustment->value,
            ]);

            Flash::success(__("Stock for product $product->id has been created successfully"));
        });

        return redirect()->route('dashboard.stocks.index');
    }
}
