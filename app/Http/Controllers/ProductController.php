<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        if (Auth::user()->type === 'admin')
        {
            return view('products.create');
        }
        return redirect()->route('products');
    }
    public function store(Request $request)
    {
        $request->validate([
            'inventoryId' => 'required',
            'description' => 'required',
        ]);

        $product = new Product([
            'inventoryId' => $request->get('inventoryId'),
            'description' => $request->get('description'),
        ]);

        $product->save();
        return redirect()->route('products.create')->with('success', 'Product saved!');
    }
}
