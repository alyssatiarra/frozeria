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
        return view('product.index', compact('category'));
        
    }

    public function show($id)
    {
        // Code to display a specific product
        $product = Product::findOrFail($id);
        return view('product.show', compact('product'));
    }

    public function create()
    {
        // Code to show a form for creating a new product
        return view('product.create');
    }

    public function store(Request $request)
    {
        // Code to save a new product to the database
        $product = Product::create($request->all());
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
