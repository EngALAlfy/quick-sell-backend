<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\PurchaseOrderDataTable;
use App\Http\Controllers\Controller;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(PurchaseOrderDataTable $dataTable)
    {
        return $dataTable->render('dashboard.purchase-orders.index');
    }

    public function show(Request $request, PurchaseOrder $purchaseOrder)
    {
        return view('dashboard.purchase-orders.show', compact('purchaseOrder'));
    }


    public function create(Request $request)
    {
        return view('dashboard.purchase-orders.create');
    }
}
