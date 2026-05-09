<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
private  $posts = [
        ["id" => 1, "title" => "title 1", "description" => "Description 1", "creator" => "Mona Ali", "created_at"=> "2026-05-05" ],
        ["id" => 2, "title" => "title 2", "description" => "Description 2", "creator" => "Mona Ali", "created_at"=> "2026-05-05" ],
        ["id" => 3, "title" => "title 3", "description" => "Description 3", "creator" => "Mona Ali", "created_at"=> "2026-05-05" ]
    ];
    //Paginator::useBootstrapFive(); Paginator::useTailwind();
    public function index() {
        /*$posts = Post::where("id", "1")->get();
        dd($posts);*/

//        $user = User::with("posts")->find(1);
//        dd($user->posts);

        $posts = Post::with("user")->paginate(15);

//        dd($posts);
        return view("posts.index", [ "posts" => $posts  ]);
    }

    public function show($id){
        $post = Post::where("id", $id)->with("comments")->firstorfail();

        return view("posts.show", [ "post" => $post ]);
    }


    public function create(){
        $users = User::all();
        return view("posts.create", compact("users"));
    }

    public function store(Request $request){
        // Create new post in database
//        // dd($request->all());

        /*$post = Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "creator" => $request->creator
        ]);*/


        Post::create($request->except("_token"));

//        dd($post);
        return redirect()->route("posts.index");
    }


    public function edit($id){
        $post = Post::findorfail($id);
        $users = User::all();
        return view("posts.edit", [ "post" => $post, "users" => $users ]);
    }


    public function update(Request $request, $id)
    {
        $post = Post::findorfail($id);
        $post->update($request->except("_token", "_method"));

        return redirect()->route("posts.index");
    }

    public function destroy($id){
        $post = Post::findorfail($id);
        $post->delete();

        return redirect()->route("posts.index");
    }

}
