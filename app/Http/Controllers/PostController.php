<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use App\Traits\UploadImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use UploadImageTrait;
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

    public function store(StorePostRequest $request){
        // Create new post in database
//        // dd($request->all());

        /*$post = Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "creator" => $request->creator,
            "image" = $imagepath
        ]);*/


        /*$validated = $request->validate([
            'title' => ['required', "min:5", "max:255", "unique:posts", "string"],
            'description' => ['required', "min:10"],
            "user_id" => ['required', "exists:users,id", "integer"]
        ], [
            "title.required" => "please enter title, Title is required",
            "title.min" => "التايتل لازم يكون اكتر من 5 حروف",
            "description.required" => "please enter description, Description is required",
            "description.min" => "الوصف لازم يكون اكتر من 10 حروف",
            "user_id.required" => "please select user, User is required",
            "user_id.exists" => "please select valid user, User must exist in users table"
        ]);*/

        $validated = $request->validated();

//      $errors - @error("title")
//      dd($validated);

//        Post::create($request->except("_token"));

        if ($request->hasFile('image')) {
//            $imagePath = $request->file('image')->store('posts', 'public');
            $imagePath = $this->uploadImage($request, 'posts', 'image');

        }

        $validated["image"] = $imagePath;

        Post::create($validated);

//        dd($post);
        return redirect()->route("posts.index")->with('success', 'Post created successfully');
//            ->with('info', 'Extra info');
        // ->withSuccess('Saved successfully'); Flash Messages
    }


    public function edit($id){
        $post = Post::findorfail($id);
        $users = User::all();
        return view("posts.edit", [ "post" => $post, "users" => $users ]);
    }


    public function update(UpdatePostRequest $request, $id)
    {
        $validated = $request->validated();

        $post = Post::findorfail($id);
        $oldimage = $post->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');

            if($oldimage){
                Storage::disk("public")->delete($oldimage);
            }
            $validated["image"] = $imagePath;
        }

        $post->update($validated);

        return redirect()->route("posts.index")->with('success', 'Post updated successfully');
    }

    public function destroy($id){
        $post = Post::findorfail($id);

        if($post->image){
            Storage::disk("public")->delete($post->image);
        }

        $post->delete();

        return redirect()->route("posts.index")->with('error', 'Post deleted successfully');
    }

}
