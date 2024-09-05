<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\StockDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StockStoreRequest;
use App\Http\Requests\StockUpdateRequest;
use App\Models\Product;
use App\Models\Stock;
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

    public function store(StockStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $stock = Stock::create($request->validated());

            // Here you might want to create a related transaction
            // $stock->transactions()->create([...]);

            Flash::success(__("Stock for product $stock->product_id has been created successfully"));
        });

        return redirect()->route('dashboard.stocks.index');
    }

    public function show(Request $request, Stock $stock)
    {
        return view('dashboard.stocks.show', compact('stock'));
    }

    public function edit(Request $request, Stock $stock)
    {
        $products = Product::pluck('name', 'id');
        return view('dashboard.stocks.edit', compact('stock', 'products'));
    }

    public function update(StockUpdateRequest $request, Stock $stock)
    {
        DB::transaction(function () use ($request, $stock) {
            $stock->update($request->validated());

            // Here you might want to update a related transaction
            // $stock->transactions()->update([...]);

            Flash::success(__("Stock for product $stock->product_id has been updated successfully"));
        });

        return redirect()->route('dashboard.stocks.index');
    }

    public function destroy(Request $request, Stock $stock)
    {
        $stock->delete();
        Flash::success(__("Stock for product $stock->product_id has been deleted successfully"));
        return redirect()->route('dashboard.stocks.index');
    }
}
