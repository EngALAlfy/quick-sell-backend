<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): Response
    {
        $categories = Category::all();

        return view('category.index', compact('categories'));
    }

    public function create(Request $request): Response
    {
        return view('category.create');
    }

    public function store(CategoryStoreRequest $request): Response
    {
        $category = Category::create($request->validated());

        $request->session()->flash('category.id', $category->id);

        return redirect()->route('categories.index');
    }

    public function show(Request $request, Category $category): Response
    {
        return view('category.show', compact('category'));
    }

    public function edit(Request $request, Category $category): Response
    {
        return view('category.edit', compact('category'));
    }

    public function update(CategoryUpdateRequest $request, Category $category): Response
    {
        $category->update($request->validated());

        $request->session()->flash('category.id', $category->id);

        return redirect()->route('categories.index');
    }

    public function destroy(Request $request, Category $category): Response
    {
        $category->delete();

        return redirect()->route('categories.index');
    }
}
