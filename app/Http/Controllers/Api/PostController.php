<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use app\Http\Controllers\Api\PostController;
class ApiPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum'); 
    }

    // GET api/posts - Get all posts with pagination and eager-loaded user
    public function index()
    {
        // $posts = Post::with('user')->paginate(10); // Eager load the user relationship
        $posts = Post::all(); // Eager load the user relationship
        return PostResource::collection($posts);
    }

    // GET api/posts/{id} - Get a single post with eager-loaded user
    public function show($id)
    {
        $post = Post::with('user')->findOrFail($id); // Eager load the user relationship
        return new PostResource($post);
    }

    // POST api/posts - Create a new post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|unique:posts,title',
            'content' => 'required|string|min:10',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(), 
        ];

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $timestamp = now()->format('Ymd_His');
            $extension = $file->getClientOriginalExtension();
            $filename = "{$timestamp}_image.{$extension}";
            $path = $file->storeAs('posts', $filename, 'public');
            $data['image'] = $path;
        }

        $post = Post::create($data);

        return new PostResource($post);
    }
}
