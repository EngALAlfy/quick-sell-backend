<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\SupplierDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierStoreRequest;
use App\Http\Requests\SupplierUpdateRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class SupplierController extends Controller
{
    public function index(SupplierDataTable $dataTable)
    {
        return $dataTable->render('dashboard.suppliers.index');
    }

    public function create(Request $request)
    {
        return view('dashboard.suppliers.create');
    }

    public function store(SupplierStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $supplier = Supplier::create($request->validated());

            Flash::success(__("Supplier $supplier->name has been created successfully"));
        });

        return redirect()->route('dashboard.suppliers.index');
    }

    public function show(Request $request, Supplier $supplier)
    {
        return view('dashboard.suppliers.show', compact('supplier'));
    }

    public function edit(Request $request, Supplier $supplier)
    {
        return view('dashboard.suppliers.edit', compact('supplier'));
    }

    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {
        DB::transaction(function () use ($request, $supplier) {
            $supplier->update($request->validated());

            Flash::success(__("Supplier $supplier->name has been updated successfully"));
        });

        return redirect()->route('dashboard.suppliers.index');
    }

    public function destroy(Request $request, Supplier $supplier)
    {
        $supplier->delete();
        Flash::success(__("Supplier $supplier->name has been deleted successfully"));
        return redirect()->route('dashboard.suppliers.index');
    }
}
