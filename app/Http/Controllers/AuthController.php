<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // showRegisterForm
    public function showRegisterForm(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('register');
    }


    // register
    public function register(Request $request): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        //$validated["password"] = Hash::make($validated["password"]); // password automatic hashed
        $user = User::create([
            "name" => $validated["name"],
            "email" => $validated["email"],
            "password" => $validated["password"],

        ]);
        auth()->login($user); // Create session at SESSION_DRIVER=database

        return redirect("/posts")->with("success", "You are now logged in");
    }
}
