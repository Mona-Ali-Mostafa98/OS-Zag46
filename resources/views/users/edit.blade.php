@extends("layouts.app")
@section("page title", "Create user")
@section("content")
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Create user</h1>
    </div>

    <div class="row">
        <!-- Add form for create user -->
        <form method="post" action="{{ route("users.update", $user->id) }}">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter user last name" value="{{ old('name', $user->name) }}"/>
                @error('name')
                <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter user email" value="{{ old('email', $user->email) }}"/>
                @error('email')
                <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror
            </div>
            {{-- password --}}
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Enter user password"/>
                @error('password')
                <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{-- password_confirmation --}}
            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" id="password_confirmation" placeholder="Confirm user password"/>
                @error('password_confirmation')
                <div class="mt-2 text-danger">{{ $message }}</div>
                @enderror
            </div>

            {{--<div class="mb-3">
                <label for="created_at" class="form-label">Created At</label>
                <input type="text" class="form-control" id="created_at" name="created_at" placeholder="Enter created at"/>
            </div>--}}
            <button type="submit" class="btn btn-primary">Create user</button>
        </form>
    </div>
@endsection
