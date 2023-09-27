<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use App\Models\Post;
class PostController extends Controller {
    public function create() {
        return view("manageposts.userposts");
    }
    public function index() {
        $messages = Post::all();
        return view('manageposts\allposts', compact('messages'));
    }
    public function show() {
        $messages = Post::all();
        return view('manageposts\show', compact('messages'));
    }
    public function edit($id) {
        $post = Post::find($id);
        return view("manageposts\postedit", ["post" => $post]);
    }
    public function update(StorePostRequest $request, $id) {
        $request->validated();
        $post = Post::find($id);
        if (!$post) {
            return redirect()->back()->with("error", "Post not found");
        }
        $post->title = $request->input("title");
        $post->message = $request->input("message");
        if ($request->hasFile("new_file_path")) {
            $request->validate([
                "new_file_path" => "image|mimes:jpeg,png,jpg,gif|max:2048",
            ]);

            if ($post->file_path) {
                Storage::delete($post->file_path);
            }
            $imagePath = $request->file("new_file_path")->store("public/images");
            $post->file_path = asset('storage/' . str_replace('public/', '', $imagePath));
        }
        $post->save();
        return redirect('postedit')->with("success", "Post updated successfully");
    }
    public function destroy(Request $request, $id){
        $post = POST::find($id);
        if(!$post){
            return('Post Not Found');
        }
        $post->delete();
        if($post->delete()){
            Toastr::success("Post Deleted successfully!", "Success");
        }
        else{
            Toastr::error("Post Not Delete", "Error");
        }
        return back();

    }
    public function store(StorePostRequest $request) {
        $validatedData = $request->validated();
        $user_id = auth()->user()->id;
        if ($request->hasFile('file_path')) {
            $imagePath = $request->file('file_path')->store('public/images');
            $post = Post::create(['title' => $validatedData['title'],
                                  'message' => $validatedData['message'],
                                  'file_path' => asset('storage/' . str_replace('public/', '', $imagePath)),
                                  'user_id' => $user_id, ]);
            if ($post) {
                Toastr::success("Post created successfully!", "Success");
            } else {
                Toastr::error("Failed to create the post. Please try again.", "Error");
            }
        } else {
            Toastr::error("No image file uploaded.", "Error");
        }
        return redirect()->route("dashboard");
    }
    public function list() {
        $posts = Post::with("user")->get();
        $datas = json_decode($posts);
        return $datas;
    }
}
