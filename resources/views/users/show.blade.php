@extends("layouts.app")
@section("page title", "Post Details")
@section("content")
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>User Details</h1>
    </div>
    <div class="row">
        <!-- Post cards will be displayed here -->
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $user['name'] }}</h5>
                <p class="card-text">{{ $user['email'] }}</p>
                <a href="{{ route("users.index") }}" class="btn btn-outline-success btn-sm">Back</a>
                <a href="{{ route("users.edit", $user->id) }}" class="btn btn-outline-warning btn-sm ms-1">Edit</a>
                <a href="{{ route("users.destroy", $user->id) }}" class="btn btn-outline-danger btn-sm ms-1" onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this user?')) { document.getElementById('delete-form').submit(); }">Delete</a>

                <form id="delete-form" action="{{ route("users.destroy", $user->id) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
    </div>
@endsection
