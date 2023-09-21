<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Yoeunes\Toastr\Facades\Toastr;
use App\Models\Post; 

class PostController extends Controller {
    // Display a form to create a new post
    public function create() {
        return view("userposts");
    }
    // Store a newly created post in the database
    public function store(StorePostRequest $request) {
        // Validate the form data
        $validate = $request->validated();
        $validate['user_id'] = auth()->id();
        $post = Post::create($validate);
        // Save the post to the database
        $post->save();
        // Check if the post was successfully saved
        if ($post) {
            // Show a success Toastr notification
            Toastr::success("Post created successfully!", "Success");
        } else {
            // Show an error Toastr notification
            Toastr::error("Failed to create the post. Please try again.", "Error");
        }
        // Redirect back to the form or any other page as needed
        return redirect()->route("dashboard");
    }
    public function list() {
        $posts = Post::with("user")->get();
        $data = json_decode($posts);
        return $data;
    }    
}
