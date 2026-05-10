<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthController;

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


Route::get("/posts", [PostController::class, "index"])->name("posts.index");
Route::get("/posts/create", [PostController::class, "create"])->name("posts.create"); // get form of create new post
Route::post("/posts", [PostController::class, "store"])->name("posts.store");
Route::get("/posts/{post}", [PostController::class, "show"] )->name("posts.show");
Route::get("posts/{post}/edit", [PostController::class, "edit"])->name("posts.edit");
Route::put("posts/{post}", [PostController::class, "update"])->name("posts.update");
Route::delete("/posts/{post}", [PostController::class, "destroy"] )->name("posts.destroy");


Route::post("posts/{post}/comments", [CommentController::class, "store"])->name("comments.store");


Route::resource("users", UserController::class);

Route::get("/register", [AuthController::class, "showRegisterForm"])->name("users.showRegisterForm");
Route::post("/register", [AuthController::class, "register"])->name("users.register");
