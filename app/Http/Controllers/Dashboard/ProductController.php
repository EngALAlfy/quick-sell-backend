<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ProductDataTable;
use App\Enums\StockType;
use App\Enums\TransactionType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class ProductController extends Controller
{
    public function index(ProductDataTable $dataTable)
    {
        return $dataTable->render('dashboard.products.index');
    }

    public function create(Request $request)
    {
        $categories = Category::pluck('name', 'id');
        return view('dashboard.products.create', compact('categories'));
    }

    public function store(ProductStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $data = $request->validated();
            $product = Product::create($data);

            if ($request->has("image_storage_path")) {
                update_media($request->only("image_storage_path"), $product, "image_storage_path", "image");
            }
            Flash::success(__("Product $product->name has been created successfully"));
        });

        return redirect()->route('dashboard.products.index');
    }

    public function show(Request $request, Product $product)
    {
        return view('dashboard.products.show', compact('product'));
    }

    public function edit(Request $request, Product $product)
    {
        $categories = Category::pluck('name', 'id');
        return view('dashboard.products.edit', compact('product', 'categories'));
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        DB::transaction(function () use ($request, $product) {
            $product->update($request->validated());
            if ($request->has("image_storage_path")) {
                update_media($request->only("image_storage_path"), $product, "image_storage_path", "image");
            }
            Flash::success(__("Product $product->name has been updated successfully"));
        });

        return redirect()->route('dashboard.products.index');
    }

    public function destroy(Request $request, Product $product)
    {
        $product->delete();
        Flash::success(__("Product $product->name has been deleted successfully"));
        return redirect()->route('dashboard.products.index');
    }
}
