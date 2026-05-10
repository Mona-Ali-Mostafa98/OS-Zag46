@extends("layouts.app")
@section("page title") Posts @endsection
@section("content")
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Post List</h1>
        <a href="{{ route("posts.create") }}" class="btn btn-success">Create Post</a>
    </div>
    <div class="row">
        {{ \Illuminate\Support\Facades\Auth::user()?->name }}
        {{ auth()->user()?->name }}
        {{ auth()->id() }}

        <form action="{{ route("logout") }}" method="post">
            @csrf
            <button type="submit" class="btn btn-link">Logout</button>
        </form>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Creator</th>
                <th scope="col">Created at</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($posts as $post)
                <tr>
                    <td>{{ $post->id }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->user?->name }}</td>
                    <td>{{ $post->created_at }}</td>
                    <td>
                        <a href="{{ route("posts.show", ["post" =>$post->id ]) }}" class="btn btn-outline-success btn-sm">View</a>
                        @auth
                        <a href="{{ route("posts.edit", ["post" => $post->id ]) }}" class="btn btn-outline-warning btn-sm ms-1">Edit</a>
                        @endauth
                        @if(auth()->user())
{{--                        <a href="" class="btn btn-outline-danger btn-sm ms-1">Delete</a>--}}
                        <form method="post" action="{{ route("posts.destroy", $post['id']) }}" class="d-inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-outline-danger btn-sm ms-1">Delete</button>
                        </form>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $posts->links() }}
    </div>
@endsection



