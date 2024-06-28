<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $products = Product::select('name','price','image')->latest()->take(3)->get();
        return view('Front.services.services',compact('products'));
    }
}
