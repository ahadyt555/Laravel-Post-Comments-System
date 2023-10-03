<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        "body" => "required|string",
    ]);

    $user = auth()->user();

    foreach ($user->posts as $post) {

        $comment = Comment::create([
            "post_id" => $post->id,
            "user_id" => $user->id,
            "body" => $request->input("body"),
        ]);

        $comment->save();

        if ($comment->wasRecentlyCreated) {
            return redirect()->back()->with('success', 'Comment added successfully.');
        } else {
            return redirect()->back()->with('error', 'Comment Not added.');
        }
    }
}


   
public function show($id)
{
    $post = Post::find($id);

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