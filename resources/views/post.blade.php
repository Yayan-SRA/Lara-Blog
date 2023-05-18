{{-- @dd($post) --}}

@extends('layouts.main')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <h1 class="mb-3">{{ $post->title }}</h1>
                <p>By. <a href="/authors/{{ $post->author->authorname }}"
                        style="text-decoration: none">{{ $post->author->name }}</a>
                    in <a href="/posts?category={{ $post->category->slug }} "
                        style="text-decoration: none">{{ $post->category->name }}</a>
                </p>
                @if ($post->image)
                    <div style="max-height: 400px; overflow:hidden;text-align:center">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                            class="img-fluid">
                    </div>
                @else
                    <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}"
                        alt="{{ $post->category->name }}" class="img-fluid mt-1">
                @endif
                <article class="my-3 fs-5" style="text-align: justify">
                    {!! $post->body !!}
                </article>
                <a href="/posts">
                    <button class="btn btn-primary">Back</button>
                </a>
            </div>
        </div>
    </div>
@endsection
