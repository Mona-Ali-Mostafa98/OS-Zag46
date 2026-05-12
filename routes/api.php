<?php

use App\Http\Controllers\Apis\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Apis\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

///api/testapi

Route::get("/testapi", function () {
    return "test";
});

Route::get("/posts", [PostController::class, 'index'])->middleware('auth:sanctum');
Route::get("/posts/{post}", [PostController::class, 'show']);
Route::post("/posts", [PostController::class, 'store']);
// update
//delete
Route::delete("/posts/{post}", [PostController::class, 'destroy']);

//Route::apiResource("posts", PostController::class);

Route::post('/login', [AuthController::class, 'login']);


