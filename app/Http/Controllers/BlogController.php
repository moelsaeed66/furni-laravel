<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('author:id,name')->latest()->take(3)
            ->get(['title', 'image', 'description', 'author_id', 'created_at' , 'slug']);

        return view('front.blog.index' , compact('blogs'));
    }

    public function show(string $slug)
    {
        $blog = Blog::with('author:id,name')
            ->select('title', 'image', 'description', 'author_id', 'created_at' , 'slug')
            ->where('slug', $slug)
            ->first();
        return view('front.blog.show',compact('blog'));
    }
}
