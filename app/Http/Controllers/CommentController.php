<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $request['post_id'] = $post_id;
        $comment = Comment::create($request->except("_token"));

//        dd($comment);
        return redirect()->route("posts.show", $post_id);
    }
}
