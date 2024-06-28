<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::latest()->take(3)->get(['name', 'price', 'image', 'description']);
        $blogs = Blog::with('author:id,name')->latest()->take(3)->get(['title', 'image', 'description', 'author_id', 'created_at' , 'slug']);

        return view('index', compact('products', 'blogs'));
    }

}
