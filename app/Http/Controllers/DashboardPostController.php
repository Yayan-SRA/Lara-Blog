<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\returnSelf;
use Cviebrock\EloquentSluggable\Services\SlugService;

class p
{
    // buat property untuk post
    var $id;
    var $user_id;
    var $category_id;
    var $title;
    var $slug;
    var $body;
    var $image;
}

class DashboardPostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        // dd($user);
        // bisa juga dituliskan 
        // $user = auth()->user;
        return view('dashboard.posts.index', [
            'title' => 'My Posts',
            'posts' => Post::where('user_id', $user->id)->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        $x = new p();
        $y = Str::random(30);
        $x->id = $y;
        return view('dashboard.posts.post', [
            'title' => 'Create New Post',
            'post' => $x,
            'key' => $y,
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        // ddd($request);
        $validatedData = $request->validate([
            'title' => 'required|string|min:3|max:255',
            'slug' => 'required|string|min:3|max:255|unique:posts',
            'image' => 'image|file|max:1024',
            'category_id' => 'required',
            'body' => 'required',
        ]);

        if ($request->file('image')) {
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($validatedData['body']), 200);

        // cara post dg code singkat, tpi semua data yang mau diisi masukan ke variabel terlebih dahulu
        Post::create($validatedData);

        // cara post lain, tpi semua data yang mau diisi tidak perlu dimasukan ke variabel terlebih dahulu
        // Post::create([
        //     'title' => $validatedData['title'],
        //     'slug' => $validatedData['slug'],
        //     'category_id' => $validatedData['category_id'],
        //     // 'excerpt' => substr($validatedData['body'], 3, 100),
        //     'excerpt' => $validatedData['body'],
        //     'body' => $validatedData['body'],
        //     'user_id' => auth()->user()->id,
        // ]);

        // return $validatedData;

        return redirect('/dashboard/posts')->with('success', "New post : $request->title has been added");
        // $request->session()->flash('success', 'New post has been added');
        // return redirect('/dashboard/posts');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        error_log($post);
        return view('dashboard.posts.show', [
            'title' => 'Detail' . $post->title,
            'post' => $post,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('dashboard.posts.post', [
            'title' => 'Edit Post',
            'post' => $post,
            'key' => '',
            'categories' => Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // return $post;
        $rules = ([
            'title' => 'required|string|min:3|max:255',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required',
        ]);

        if ($post->slug != $request->slug) {
            $rules['slug'] = 'required|string|min:3|max:255|unique:posts';
        }

        $validatedData = $request->validate($rules);

        if ($request->file('image')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($validatedData['body']), 200);

        Post::where('id', $post->id)
            ->update($validatedData);
        // Post::update($validatedData, $post->slug);

        return redirect('/dashboard/posts')->with('success', "The post $request->title has been updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // return $post;
        if ($post->image) {
            Storage::delete($post->image);
        }
        Post::destroy($post->id);

        return redirect('/dashboard/posts')->with('success', "Post : $post->title has been deleted");
    }

    public function createSlug(Request $request)
    {
        // dd($request->title);
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
