@extends("layouts.app")
@section("page title", "Post Details")
@section("content")
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Post Details</h1>
    </div>
    <div class="row">
        <!-- Post cards will be displayed here -->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $post['title'] }}</h5>
                <p class="card-text">{{ $post['description'] }}</p>
                <p class="card-text"><small class="text-muted">Posted by: {{ $post['creator'] }}</small></p>
                <p class="card-text">{{ $post['created_at'] }}</p>
                <a href="{{ route("posts.index") }}" class="btn btn-outline-success btn-sm">Back</a>
                <a href="" class="btn btn-outline-warning btn-sm ms-1">Edit</a>
                <a href="" class="btn btn-outline-danger btn-sm ms-1">Delete</a>
            </div>
        </div>

    </div>
@endsection
