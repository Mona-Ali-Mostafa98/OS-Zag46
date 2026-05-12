<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;
use Laravel\Socialite\Socialite;

Route::get('/', function () {
    return view('welcome');
});

Route::get("/test" , function(){
    $posts = [
        ["id" => 1, "title" => "title 1", "description" => "Description 1", "creator" => "Mona Ali", "created_at"=> "2026-05-05" ],
        ["id" => 2, "title" => "title 2", "description" => "Description 2", "creator" => "Mona Ali", "created_at"=> "2026-05-05" ],
        ["id" => 3, "title" => "title 3", "description" => "Description 3", "creator" => "Mona Ali", "created_at"=> "2026-05-05" ]
    ];

    return view("index", [ "posts" => $posts ]);
});

//Route::get("/test2" , [PostController::class, "test2"]);



//Route::get("/posts", [PostController::class, "index"])->name("posts.index");
//Route::get("/posts/create", [PostController::class, "create"])->name("posts.create")->middleware("auth"); // get form of create new post
//Route::post("/posts", [PostController::class, "store"])->name("posts.store")->middleware("auth");
//Route::get("/posts/{post}", [PostController::class, "show"] )->name("posts.show");
//Route::get("posts/{post}/edit", [PostController::class, "edit"])->name("posts.edit")->middleware("auth");
//Route::put("posts/{post}", [PostController::class, "update"])->name("posts.update")->middleware("auth");
//Route::delete("/posts/{post}", [PostController::class, "destroy"] )->name("posts.destroy")->middleware("auth");

Route::resource("posts", PostController::class)->middleware("auth");

Route::post("posts/{post}/comments", [CommentController::class, "store"])->name("comments.store");


Route::resource("users", UserController::class);

Route::get("/register", [AuthController::class, "showRegisterForm"])->name("users.showRegisterForm");
Route::post("/register", [AuthController::class, "register"])->name("users.register");

Route::get("/login", [AuthController::class, "showLoginForm"])->name("login");
Route::post("/login", [AuthController::class, "login"])->name("users.login");

Route::post("logout", [AuthController::class, "logout"])->name("logout");

\Illuminate\Support\Facades\Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/auth/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
    // create data

     dd($user);

});
