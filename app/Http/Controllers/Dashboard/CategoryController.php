<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;

class CategoryController extends Controller
{
    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('dashboard.categories.index');
    }

    public function create(Request $request)
    {
        return view('dashboard.categories.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $category = Category::create($request->validated());

            Flash::success(__("Category $category->name has been created successfully"));
        });

        return redirect()->route('dashboard.categories.index');
    }

    public function show(Request $request, Category $category)
    {
        return view('dashboard.categories.show', compact('category'));
    }

    public function edit(Request $request, Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        DB::transaction(function () use ($request, $category) {
            $category->update($request->validated());

            Flash::success(__("Category $category->name has been updated successfully"));
        });

        return redirect()->route('dashboard.categories.index');
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();
        Flash::success(__("Category $category->name has been deleted successfully"));
        return redirect()->route('dashboard.categories.index');
    }
}
