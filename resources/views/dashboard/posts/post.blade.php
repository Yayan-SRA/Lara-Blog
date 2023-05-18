{{-- @dd($categories) --}}
{{-- @dd($post) --}}
@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
        {{-- <h1 class="h2">{{ $post }}</h1> --}}
    </div>
    <div class="row justify-content-center mb-4">
        <div class="col-md-8">
            @if ($post->id !== $key)
                <form method="post" action="/dashboard/posts/{{ $post->slug }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                @else
                    <form method="post" action="/dashboard/posts" enctype="multipart/form-data">
                        @csrf
            @endif
            <div class="form-floating mb-3">
                <input type="text"
                    class="form-control @error('title')
                        is-invalid
                    @enderror"
                    id="title" required value="{{ old('title', $post->title) }}" name="title" autofocus>
                <label for="title">Title</label>
                @error('title')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="text"
                    class="form-control @error('slug')
                        is-invalid
                    @enderror"
                    id="slug" required value="{{ old('slug', $post->slug) }}" name="slug" readonly>
                <label for="slug">Slug</label>
                @error('slug')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <select
                    class="form-select @error('category_id')
                        is-invalid
                    @enderror"
                    id="category_id" required name="category_id">
                    @foreach ($categories as $category)
                        @if (old('category_id') == $category->id || $post->category_id == $category->id)
                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                        @else
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                    @endforeach
                </select>
                <label for="category_id">Category</label>
                @error('category_id')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class=" mb-3">
                <label for="image" class="form-label text-secondary" style="margin-left:1em">
                    <small>Post image</small>
                </label>
                @if ($post->image)
                    <input value="{{ $post->image }}" name="oldImage" hidden>
                    <img src="{{ asset('storage/' . $post->image) }}" class="img-preview img-fluid mb-2 col-sm-5 d-block"
                        style="margin-left:1em">
                    {{-- <p>
                        <strong style="margin-left: 1em">This post already have an image</strong>
                    </p> --}}
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                @endif
                <input class="form-control @error('image') is-invalid @enderror" type="file" id="image"
                    name="image" onchange="previewImage()">
                @if ($post->image)
                @endif
                @error('image')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
            </div>
            <div class="mb-3">
                <label for="body" class="form-label text-secondary" style="margin-left:1em"><small>Body</small>
                </label>
                {{-- <textarea class="form-control" id="body" rows="5" required value="{{ old('') }}" name="body"></textarea> --}}
                <input id="body" type="hidden" required value="{{ old('body', $post->body) }}" name="body">
                <trix-editor input="body"></trix-editor>
                @error('body')
                    <p class="text-danger">
                        {{ $message }}
                    </p>
                @enderror
                {{-- <label for="body">Body</label> --}}
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary"><span data-feather="save" class="mb-1"></span>
                    Save</button>
            </div>
            </form>
        </div>
    </div>

    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/dashboard/posts/createSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug)
        });

        // Trix editor
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });

        function previewImage() {
            const img = document.querySelector('#image');
            const imgPre = document.querySelector('.img-preview');

            imgPre.style.display = 'block';
            imgPre.style.marginLeft = '1em';

            const oFReader = new FileReader();
            oFReader.readAsDataURL(img.files[0]);

            oFReader.onload = function(OfREvent) {
                imgPre.src = OfREvent.target.result;
            }
        }
    </script>
@endsection
