@extends("layouts.app")
@section("page title") Posts @endsection
@section("content")
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Post List</h1>
    </div>
    <div class="row">
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
                    <td>{{ $post['id'] }}</td>
                    <td>{{ $post['title'] }}</td>
                    <td>{{ $post['creator'] }}</td>
                    <td>{{ $post['created_at'] }}</td>
                    <td>
                        <a href="{{ route("posts.show", ["post" =>$post['id']]) }}" class="btn btn-outline-success btn-sm">View</a>
                        <a href="{{ route("posts.edit", ["post" => $post['id']]) }}" class="btn btn-outline-warning btn-sm ms-1">Edit</a>
                        <a href="" class="btn btn-outline-danger btn-sm ms-1">Delete</a>
{{--                        <form method="post" action="{{ route("posts.destroy", $post['id']) }}">--}}
{{--                            @csrf--}}
{{--                            @method("DELETE")--}}
{{--                            <button type="submit" class="btn btn-outline-danger btn-sm ms-1">Delete</button>--}}
{{--                        </form>--}}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection



