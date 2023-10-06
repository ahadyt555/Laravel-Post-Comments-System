<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $request->validate([
            "body" => "required|string",
        ]);
        $comments = Comment::create([
            "post_id" => $post_id,
            "user_id" => auth()->user()->id,
            "body" => $request->input("body"),
        ]);


    $comments->save();
    if($comments->wasRecentlyCreated){
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
    else{
        return redirect()->back()->with('error', 'Comment Not added.');
    }

   
}
public function show($post_id)
{
    $post = Post::find($post_id);
    if (!$post) {
        return redirect()->back()->with("error", "Post not found");
    }
    $comments = $post->comments;

    return view("comments", [
        "post" => $post,
        "comments" => $comments,
    ]);
}


    
}