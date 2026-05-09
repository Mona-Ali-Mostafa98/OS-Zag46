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


                <h2 class="mt-3">Comments</h2>
                @forelse($post->comments as $comment)
                    <div class="card-body">
                        <p class="card-text">{{ $comment->message }}</p>

                    </div>
                @empty
                    <div class="card-body">
                        <p class="card-text">No comments yet.</p>
                    </div>

                @endforelse



                <form action="{{ route("comments.store", $post->id) }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="1"/>
    {{--                <input type="hidden" name="post_id" value="{{ $post->id }}"/>--}}

                    <textarea name="message" class="form-control"></textarea>

                    <button type="submit" class="btn btn-success">Send Comment</button>
                </form>
            </div>
        </div>
    </div>
@endsection
