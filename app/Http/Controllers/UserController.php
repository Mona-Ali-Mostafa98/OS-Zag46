<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view("users.index", compact("users"));
    }

    public function create()
    {
        return view("users.create");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:8|confirmed",
        ]);
        //================================ way 1 ================================
        User::create($data);
        /*
        //================================ way 2 ================================
        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt($request->password),
        ]);
        //================================ way 3 ================================
        User::create($request->except("_token"));
        // ================================ way 4 ================================
        // you dont need fillable
        $user = new User();
        $user->name = $data["name"];
        $user->email = $data["email"];
        $user->password = $data["password"];
        $user->save();
        */

        return redirect()->route("users.index")->with("success", "User created successfully.");
    }

    public function show(User $user)
    {
        // ================================ way 1 ================================
        // Route Model Binding:
        // Laravel automatically converts the ID from the URL into a Model instance.

        // Requirements:
        // 1. The route parameter name must match the controller parameter name.
        // 2. You must use type hinting (e.g., User $user).

        // Behind the scenes, Laravel runs something like:
        // User::where('id', $value_from_url)->firstOrFail();
        // ================================ way 2 ================================
        $user = User::find($id); // user or null
        $user = User::findorfail($id); // user or 404
        // ================================ way 3 ================================
        $user = User::where("id", "=", $id)->first();
        $user = User::where("id", "=", $id)->firstorfail();
        // ================================ way 4 ================================
        $user = User::where("id", "=", $id)->limit(1)->get(); // return collection $user[0]
        //DB (Query Builder)
        //$user = DB::table('users')->where('id', 1)->first(); // performance / complex querie

        return view("users.show", compact("user"));
    }

    public function edit(User $user)
    {
        return view("users.edit", compact("user"));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            "name" => "required|string|max:255",
            "email" => "required|email|unique:users,email," . $user->id,
        ]);

        $user->update($request->only("name", "email"));

        return redirect()->route("users.show", $user)->with("success", "User updated successfully.");
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route("users.index")->with("success", "User deleted successfully.");
    }

}
