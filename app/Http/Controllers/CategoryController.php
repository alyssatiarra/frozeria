<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $categorySearchPaginate = Category::where('name_category', 'like', '%' . request('q') . '%')
            ->paginate(5)
            ->withQueryString();
        $totalProducts = Category::withCount('products')->get();
        $category = $categorySearchPaginate;
        return view('category.index', compact('category', 'totalProducts'));
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('category.show', compact('category'));
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name_category' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        if ($validatedData) {
            $category = Category::create($validatedData);
            return redirect()->route('category.index')->with('success', 'Kategori berhasil dibuat');
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        return redirect()->route('category.show', $category->id);
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name_category' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $category = Category::findOrFail($id);
        $category->update($validatedData);
        return redirect()->route('category.index')->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('category.index')->with('success', 'Kategori berhasil dihapus');
    }
}
