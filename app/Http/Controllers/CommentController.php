<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
   
public function create(Request $request)
{
    $request->validate([
        'body' => 'required|string|max:255',
    ]);

    $comment = new Comment([
        'body' => $request->input('body'),
    ]);

    $comment->save();

    return redirect()->back()->with('success', 'Comment added successfully.');
}
}
