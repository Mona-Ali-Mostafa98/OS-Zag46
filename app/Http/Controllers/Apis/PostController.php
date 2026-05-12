<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\select;

class PostController extends Controller
{

    public function index() {
        $posts = Post::with("user")->get(); //resource

//        return $posts;
        return PostResource::collection($posts);
    }

    public function show($id) {
        $post = Post::where("id", $id)->with("comments")->firstorfail();

//         return response()->json($post);
        return new PostResource($post);

    }


    public function store(StorePostRequest $request){
        $validated = $request->validated();

        $post = Post::create($validated);

        return response()->json(
            [
                "data" => new PostResource($post),
                "message" => "Post created Successfully"
            ]
            , 201);
    }

    public function destroy($id){
        $post = Post::findorfail($id);

        if($post->image){
            Storage::disk("public")->delete($post->image);
        }

        $post->delete();

        return response()->json(
            [
                "message" => "Post deleted successfully"
            ] , 200);
    }
}
