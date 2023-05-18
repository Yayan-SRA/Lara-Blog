<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $posts = ;
        // if ($request->search) {
        //     $search = $request->input('search');
        //     return view('posts', [
        //         'title' => "Posts with title : $search",
        //         'active' => 'posts',
        //         // 'posts' => Post::all()
        //         'posts' => $posts->get()
        //     ]);
        // } else {
        // $add = Post::whereRelation('category','slug' );
        // dd(request()->all());

        $title = '';
        if (request('category')) {
            $category = Category::firstWhere('slug', request('category'));
            if ($category == null) return redirect('/posts');
            $title = 'in ' . $category->name;
        } elseif (request('author')) {
            $author = User::firstWhere('username', request('author'));
            if ($author == null) return redirect('/posts');
            $title = 'by ' . $author->name;
        }
        return view('posts', [
            'title' => 'All Posts ' . $title,
            'active' => 'posts',
            // 'posts' => Post::all()
            "posts" => Post::latest()->filter(request(['search', 'category', 'author']))->paginate(7)->withQueryString()
        ]);
        // }
    }

    public function show(Post $post)
    {
        // error_log($post);
        // $data = Post::where('slug', $post)->first();
        return view('post', [
            'title' => 'Single Post',
            'active' => 'posts',
            'post' => $post
        ]);
    }

    // public function author(User $author)
    // {
    //     // error_log($post);
    //     // $data = Post::where('slug', $post)->first();
    //     return view('posts', [
    //         'title' => "Posts By Author : $author->name",
    //         'posts' => $author->posts->load('author', 'category')
    //     ]);
    // }
}
