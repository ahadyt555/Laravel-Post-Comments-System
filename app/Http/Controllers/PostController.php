<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use Illuminate\Http\Request;
use Yoeunes\Toastr\Facades\Toastr;
use App\Models\Post; 

class PostController extends Controller 
{

    public function create() {
        return view("manageposts.userposts");    }

    public function index() {
        $messages = Post::all();
        return view('manageposts\allposts', compact('messages'));
    }

    public function show() {
        $messages = Post::all();
        return view('manageposts\show', compact('messages'));
    }
    
    public function edit($id)
    {
        $post = Post::find($id);
        return view("manageposts\postedit", ["post" => $post]);
    }
    
    public function update(StorePostRequest $request, $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()
                ->back()
                ->with("error", "Post not found");
                }
                    $post->title = $request->input("title");
                    $post->message = $request->input("message");
                    $post->save();
                    return redirect()
                        ->route("manageposts.edit", ["id" => $post->id])
                        ->with("success", "Post updated successfully");                         
    }

    public function store(StorePostRequest $request) {
        $validate = $request->validated();
        $validate['user_id'] = auth()->user()->id;
        $post = Post::create($validate);
        $post->save();
        if ($post) {
            Toastr::success("Post created successfully!", "Success");
        } else {
            Toastr::error("Failed to create the post. Please try again.", "Error");
        }
        return redirect()->route("dashboard");
        }

    public function list() {
        $posts = Post::with("user")->get();
        $datas = json_decode($posts);
        return $datas;
        }    
    
}