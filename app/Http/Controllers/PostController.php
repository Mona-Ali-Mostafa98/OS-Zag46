<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
private  $posts = [
        ["id" => 1, "title" => "title 1", "description" => "Description 1", "creator" => "Mona Ali", "created_at"=> "2026-05-05" ],
        ["id" => 2, "title" => "title 2", "description" => "Description 2", "creator" => "Mona Ali", "created_at"=> "2026-05-05" ],
        ["id" => 3, "title" => "title 3", "description" => "Description 3", "creator" => "Mona Ali", "created_at"=> "2026-05-05" ]
    ];

    public function index(){
        return view("posts.index", [ "posts" => $this->posts ]);
    }

    public function show($id){
        foreach($this->posts as $post){
            if($post["id"] == $id){
                return view("posts.show", ["post" => $post]);
            }
        }

        abort(404);
    }


    public function create(){
        return view("posts.create");
    }

    public function store(Request $request){
        $newPost = [
            "title" => $request["title"],
            "description" => $request["description"],
            "creator" => $request["creator"],
            "created_at" => $request["created_at"]
        ];

        return redirect()->route("posts.index");
    }

    public function edit($id){
        foreach($this->posts as $post){
            if($post["id"] == $id){
                return view("posts.edit", ["post" => $post]);
            }
        }

        abort(404);
    }


    public function update(Request $request, $id)
    {
        dd($request->all() , $id);
    }

}
