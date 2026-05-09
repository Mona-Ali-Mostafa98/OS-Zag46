@extends("layouts.app")
@section("page title", "Create Post")
@section("content")
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Edit Post {{ $post['title'] }}</h1>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <!-- Add form for create post -->
        <form method="post" action="{{ route("posts.update", $post['id']) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Enter post title" value="{{ $post['title'] }}"/>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="description" rows="5" placeholder="Enter post description">{{ $post['description'] }}</textarea>
            </div>
            <div class="mb-3">
                <label for="creator" class="form-label">Creator</label>
                <select class="form-select" name="user_id" id="user_id">
                    <option value="" disabled>Select creator</option>
                    @foreach($users as $user)
{{--                        @if($post->id == $user->id) selected @endif--}}
                        <option value="{{ $user->id }}" {{ $post->id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection
