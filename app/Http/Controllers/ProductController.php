<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category:id,name')
            ->select('id', 'name', 'price','description','image','category_id')
            ->paginate(8)->withQueryString();
        return view('front.product.index',compact('products'));
    }

    public function show(string $name)
    {
        $product = Product::with('category:id,name')
            ->select('id', 'name', 'price','description','image','category_id')
            ->where('name', $name)->first();
        return view('front.product.show',compact('product'));
    }
}
