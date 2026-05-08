<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $category = Category::all();
        $products = Product::all();
        return view('product.index', compact('category', 'products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('product.show', compact('product', 'category'));
    }

    public function create()
    {
        $category = Category::all();
        $products = Product::all();
        return view('product.create', compact('products', 'category'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'unit' => 'required|string|max:100',
            'stock' => 'required|integer|min:0',
            'stock_min' => 'required|integer|min:0',
            'selling_price' => 'required|numeric|min:0',
            'buy_price' => 'required|numeric|min:0',
            'weight' => 'nullable|string|max:100',
            'storage_location' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validatedData) {
            $product = Product::create($validatedData);
            $storagePath = $request->file('image')->store('public/images');
            $product->image = str_replace('public/', 'storage/', $storagePath);
            $product->save();
            return redirect()->route('product.index')->with('success', 'Produk berhasil dibuat');
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        return redirect()->route('product.show', $product->id);
    }

    public function edit($id)
    {
        // Code to show a form for editing an existing product
        $product = Product::findOrFail($id);
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        // Code to update an existing product in the database
        $product = Product::findOrFail($id);
        $product->update($request->all());
        return redirect()->route('product.show', $product->id);
    }

    public function destroy($id)
    {
        // Code to delete a product from the database
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->route('product.index');
    }
}
