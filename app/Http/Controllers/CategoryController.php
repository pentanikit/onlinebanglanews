<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::with('parent')->orderBy('order_column')->paginate(50);

        if ($request->expectsJson()) {
            return response()->json($categories);
        }

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::orderBy('name')->get();
        return view('categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'parent_id'    => 'nullable|exists:categories,id',
            'name'         => 'required|string|max:255',
            'slug'         => 'required|string|max:255|unique:categories,slug',
            'type'         => 'nullable|string|max:50',
            'is_active'    => 'boolean',
            'order_column' => 'nullable|integer',
        ]);

        $category = Category::create($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $category], 201);
        }

        return redirect()->back()->with('success', 'Category created.');
    }

    public function show(Category $category, Request $request)
    {
        $category->load('children', 'parent');

        if ($request->expectsJson()) {
            return response()->json($category);
        }

        return view('categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $parents = Category::where('id', '!=', $category->id)->orderBy('name')->get();
        return view('categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'parent_id'    => 'nullable|exists:categories,id',
            'name'         => 'required|string|max:255',
            'slug'         => [
                'required',
                'string',
                'max:255',
                Rule::unique('categories', 'slug')->ignore($category->id),
            ],
            'type'         => 'nullable|string|max:50',
            'is_active'    => 'boolean',
            'order_column' => 'nullable|integer',
        ]);

        $category->update($data);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'data' => $category]);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Request $request, Category $category)
    {
        $category->delete();

        if ($request->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }
}
