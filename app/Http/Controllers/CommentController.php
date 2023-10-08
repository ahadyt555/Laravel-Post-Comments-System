<?php

namespace App\Http\Controllers;
use Yoeunes\Toastr\Facades\Toastr;
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

public function destroy(Request $request, $id)
{
    $comments = Comment::find($id);
    if (!$comments) {
        return('Comment not found');
    }
    if ($comments->delete()) {
        Toastr::success("Comment deleted successfully!", "Success");
        return redirect()->back();
    } else {
        Toastr::error("Comment not deleted", "Error");
        return redirect()->back();
    }

    return redirect()->back();
}

public function update(Request $request, $id)
{
    $editedText = $request->input('body');
    $comment = Comment::findOrFail($id);
    $comment->body = $editedText;    

    if ($comment) {
        Toastr::success("Comment Updated successfully!", "Success");
        return redirect()->back();
    } else {
        Toastr::error("Comment not Updated", "Error");
        return redirect()->back();
    }
}
    
}