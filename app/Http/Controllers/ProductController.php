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
        $productsSearchPaginate = Product::where('product_name', 'like', '%' . request('q') . '%')
            ->when(request('category_id'), function ($query) {
                $query->where('category_id', request('category_id'));
            })
            ->paginate(5)
            ->withQueryString();
        $totalProducts = Product::count();
        $totalCategory = Category::count();
        $stockMinProducts = Product::whereColumn('stock', '<=', 'stock_min') -> where('stock', '>', 0)->get();
        $stockMinCount = $stockMinProducts->count();
        $emptyStock = Product::where('stock', 0)->get();
        $emptyStockCount = $emptyStock->count();
        $products = $productsSearchPaginate;
        return view('product.index', compact('category', 'products', 'productsSearchPaginate', 'totalProducts', 'totalCategory', 'stockMinCount', 'emptyStockCount'));
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
            if ($request->hasFile('image')) {
                $validatedData['image'] = $request->file('image')
                    ->store('images', 'public');
            }
            $product = Product::create($validatedData);

            return redirect()->route('product.index')->with('success', 'Produk berhasil dibuat');
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
        return redirect()->route('product.show', $product->id);
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $category = Category::all();
        return view('product.edit', compact('product', 'category'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
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

        // dd($validatedData);

        if ($validatedData) {
            if ($request->hasFile('image')) {
                $validatedData['image'] = $request->file('image')
                    ->store('images', 'public');
            }
            $product = Product::where('id', $id)->update($validatedData);

            return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui');
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
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
