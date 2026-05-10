@extends("layouts.app")
@section("page title") users @endsection
@section("content")
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>user List</h1>
        <a href="{{ route("users.create") }}" class="btn btn-outline-info">Create User</a>
    </div>
    <div class="row">
        <table class="table table-striped table-hover table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Created at</th>
                <th scope="col">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at }}</td>
                    <td>
                        <a href="{{ route("users.show", ["user" =>$user->id ]) }}" class="btn btn-outline-success btn-sm">View</a>
                        <a href="{{ route("users.edit", ["user" => $user->id ]) }}" class="btn btn-outline-warning btn-sm ms-1">Edit</a>
{{--                        <a href="" class="btn btn-outline-danger btn-sm ms-1">Delete</a>--}}
                        <form method="post" action="{{ route("users.destroy", $user['id']) }}" class="d-inline">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-outline-danger btn-sm ms-1">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection



