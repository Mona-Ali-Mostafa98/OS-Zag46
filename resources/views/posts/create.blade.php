@extends("layouts.app")
@section("page title", "Create Post")
@section("content")
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create Post</h1>
    </div>
    <div class="row">
        <!-- Add form for create post -->
        <form method="post" action="{{ route("posts.store") }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter post title"/>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter post description"></textarea>
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Creator</label>
                <select class="form-select" name="user_id" id="user_id">
                    <option value="" selected disabled>Select creator</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            {{--<div class="mb-3">
                <label for="created_at" class="form-label">Created At</label>
                <input type="text" class="form-control" id="created_at" name="created_at" placeholder="Enter created at"/>
            </div>--}}
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection
