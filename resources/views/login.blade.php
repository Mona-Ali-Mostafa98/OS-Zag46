@extends("layouts.app")
@section("page title", "Create user")
@section("content")
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Login</h1>
    </div>

    <div class="row">
        <form method="post" action="{{ route("users.login") }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter user email" value="{{ old('email') }}"/>
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
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
@endsection
