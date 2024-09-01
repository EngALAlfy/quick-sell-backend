<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\PurchaseOrderStoreRequest;
use App\Http\Requests\PurchaseOrderUpdateRequest;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(Request $request): Response
    {
        $purchaseOrders = PurchaseOrder::all();

        return view('purchaseOrder.index', compact('purchaseOrders'));
    }

    public function create(Request $request): Response
    {
        return view('purchaseOrder.create');
    }

    public function store(PurchaseOrderStoreRequest $request): Response
    {
        $purchaseOrder = PurchaseOrder::create($request->validated());

        $request->session()->flash('purchaseOrder.id', $purchaseOrder->id);

        return redirect()->route('purchaseOrders.index');
    }

    public function show(Request $request, PurchaseOrder $purchaseOrder): Response
    {
        return view('purchaseOrder.show', compact('purchaseOrder'));
    }

    public function edit(Request $request, PurchaseOrder $purchaseOrder): Response
    {
        return view('purchaseOrder.edit', compact('purchaseOrder'));
    }

    public function update(PurchaseOrderUpdateRequest $request, PurchaseOrder $purchaseOrder): Response
    {
        $purchaseOrder->update($request->validated());

        $request->session()->flash('purchaseOrder.id', $purchaseOrder->id);

        return redirect()->route('purchaseOrders.index');
    }

    public function destroy(Request $request, PurchaseOrder $purchaseOrder): Response
    {
        $purchaseOrder->delete();

        return redirect()->route('purchaseOrders.index');
    }
}
