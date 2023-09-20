<?php 
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Yoeunes\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Models\Post; // Replace 'Post' with your actual model name if different

class PostController extends Controller
{
    // Display a form to create a new post
    public function create()
    {
        return view('userposts'); // Assuming the view name is 'userposts.blade.php'
    }

    // Store a newly created post in the database
    public function store(Request $request)
{
    // Validate the form data
    $validatedData = $request->validate([
        'title' => 'required|string|max:255',
        'message' => 'required|string',
    ]);

    // Create a new post using the validated data
    $post = new Post;
    $post->title = $validatedData['title'];
    $post->message = $validatedData['message'];

    // Save the post to the database
    $post->save();

    // Check if the post was successfully saved
    if ($post) {
        // Show a success Toastr notification
        Toastr::success('Post created successfully!', 'Success');
    } else {
        // Show an error Toastr notification
        Toastr::error('Failed to create the post. Please try again.', 'Error');
    }

    // Redirect back to the form or any other page as needed
    return redirect()->route('dashboard');
}

    // Other methods for displaying, editing, and deleting posts can be added here.
}
