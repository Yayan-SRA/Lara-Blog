@extends('dashboard.layouts.main')

@section('content')
    @if (auth()->user()->id === $post->user_id)
        <div class="container">
            <div class="row justify-content-center my-3">
                <div class="col-lg-8">
                    <h1 class="mb-3 text-center">{{ $post->title }}</h1>
                    <a href="/dashboard/posts" class="btn btn-success"><span class="mb-1" data-feather="arrow-left"></span>
                        Back
                        to
                        all my
                        posts</a>
                    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning text-white"><span
                            data-feather="edit" class="mb-1"></span>
                        Edit</a>
                    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                        @method('delete')
                        @csrf
                        <button class="btn btn-danger" onclick="return confirm('Are you sure?')"><span
                                data-feather="trash-2" class="mb-1"></span> Delete</button>
                    </form>
                    @if ($post->image)
                        <div class="mt-3" style="max-height: 400px; overflow:hidden;text-align:center">
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                                class="img-fluid">
                        </div>
                    @else
                        <img src="https://source.unsplash.com/1200x400?{{ $post->category->name }}"
                            alt="{{ $post->category->name }}" class="img-fluid mt-3">
                    @endif
                    <p>By.
                        <span style="text-decoration: none">{{ $post->author->name }}</span>
                        in <span style="text-decoration: none">{{ $post->category->name }}</span>
                    </p>
                    <article class="my-3 fs-5" style="text-align: justify">
                        {!! $post->body !!}
                    </article>
                </div>
            </div>
        </div>
    @else
        <h1 class="text-center mt-5 text-danger">ACCESS DENIED!!!</h1>
        <script>
            window.location = "/dashboard/posts";
        </script>
    @endif
@endsection
