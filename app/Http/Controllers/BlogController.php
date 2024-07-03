<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Carbon\Carbon;

use App\Models\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('home.blog', compact('posts'));
    }
    public function show($id)
    {
        $blogs = Post::orderBy('created_at', 'desc')->take(3)->get();
        $posts = Post::findOrFail($id);
        $categories = Category::get();

        return view('home.show', compact('posts', 'categories', 'blogs'));
    }
    public function category(Category $category)
    {
        $blogs = Post::where('category_id', $category->id)->get();
        return view('home.category', compact('blogs', 'category'));
    }
}
