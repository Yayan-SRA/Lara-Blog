<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // public function show(Category $category)
    // {
    //     return view('posts', [
    //         // 'page' => 'Post Category :' . {{ $category->name }},
    //         'title' => "Post By Category : $category->name",
    //         'active' => 'categories',
    //         // karena sudah ada with di model post jdi tidak perlu menggunakan load lagi, karena akan menduplikasi prosesnya jika tetap digunakan
    //         // 'posts' => $category->posts->load('author', 'category'),
    //         'posts' => $category->posts,
    //     ]);
    // }

    public function index()
    {
        return view('categories', [
            'title' => 'Categories',
            'active' => 'categories',
            'categories' => Category::all(),
        ]);
    }
}
