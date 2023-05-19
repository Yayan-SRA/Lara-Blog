{{-- @dd($categories) --}}
@extends('dashboard.layouts.main')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Post Categories</h1>
        <a href="/dashboard/posts/create" class="btn btn-success"><span data-feather="file-plus" class="mb-1"></span>
            Add New Category</a>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success col-md-10 m-auto" role="alert">
            {{ session('success') }}
        </div>
    @endif
    @if ($categories->count())
        <div class="row justify-content-center">
            <div class="table-responsive col-md-6">

                <table class="table table-striped table-sm text-center">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td style="text-align: left">{{ $category->name }}</td>
                                <td>
                                    <a href="/dashboard/posts/{{ $category->slug }}" class="badge bg-info"><span
                                            data-feather="eye"></a>
                                    <a href="/dashboard/posts/{{ $category->slug }}/edit" class="badge bg-warning"><span
                                            data-feather="edit"></a>
                                    <form action="/dashboard/posts/{{ $category->slug }}" method="post" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button class="badge bg-danger border-0"
                                            onclick="return confirm('Are you sure?')"><span
                                                data-feather="trash-2"></span></button>
                                    </form>
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
