{{-- @dd($posts) --}}
@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">My Posts</h1>
        <a href="/dashboard/posts/create" class="btn btn-success"><span data-feather="file-plus" class="mb-1"></span>
            Add New Post</a>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success col-md-10 m-auto" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($posts->count())
        <div class="row justify-content-center">
            <div class="table-responsive col-md-10">

                <table class="table table-striped table-sm text-center">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="text-align: left">{{ $post->title }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                    <a href="/dashboard/posts/{{ $post->slug }}" class="badge bg-info"><span
                                            data-feather="eye"></a>
                                    <a href="/dashboard/posts/{{ $post->slug }}/edit" class="badge bg-warning"><span
                                            data-feather="edit"></a>
                                    <form action="/dashboard/posts/{{ $post->slug }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('Are you sure?')"><span
                                                data-feather="trash-2"></span></button>
                                    </form>

                                    {{-- niatnya buat modal tpi gagal --}}
                                    <!-- Button trigger modal -->
                                    {{-- <button type="button" class="badge bg-danger border-0" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" onClick="functionDel({{ $post }})"><span
                                            data-feather="trash-2"></button> --}}
                                    <!-- Modal -->
                                    {{-- <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-3" id="exampleModalLabel">Confirm</h1> --}}
                                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button> --}}
                                    {{-- </div>
                                                <div class="modal-body">
                                                    <strong class="fs-5">Are you sure want to
                                                        delete post : <br> "<span id="title"></span>"</strong>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Cancel</button>
                                                    <input type="text" name="slug" id="slug"> --}}
                                    {{-- <form action="/dashboard/posts/id=(slug)" method="post"
                                                        class="d-inline">
                                                        @method('delete')
                                                        @csrf --}}
                                    {{-- <button class="btn btn-danger" onclick="delete()"><span
                                                            data-feather="trash-2" class="mb-1"></span> Delete
                                                        Post</button> --}}

                                    {{-- </form> --}}
                                    {{-- </div>
                                            </div>
                                        </div>
                                    </div> --}}

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        <h3 class="text-center mt-5">No posts yet</h3>
    @endif

    {{-- <script>
        function functionDel(data) {
            console.log(data)
            // console.log(data.title)
            document.getElementById("title").innerHTML = data.title;
            slug.value = data.slug
            // document.getElementById("slug").innerHTML = data.slug;
        }
    </script> --}}
@endsection
