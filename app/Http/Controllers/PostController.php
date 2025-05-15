<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    // GET /posts (index)
    public function index()
    {
        $posts = Post::whereNull('deleted_at')->paginate(5);
        return view('posts.index', compact('posts'));
    }

    // GET /posts/create
    public function create()
    {
        $users = User::all();
        return view('posts.create', compact('users'));
    }

    // POST /posts (store)
    public function store(StorePostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->created_by = $request->created_by;
        $post->user_id = 1;


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/posts'), $imageName);
            $post->image = $imageName;
        }

        $post->save();

        return redirect("/posts")->with('success', 'Post created successfully!');
    }


    // GET /posts/{post} (show)
    public function show($id)
    {
        $post = Post::with(['comments', 'user'])->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // GET /posts/{post}/edit (edit)
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $users = User::all();
        return view('posts.edit', compact('post', 'users'));
    }

    public function update(StorePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        $data = $request->validated();


        if ($request->hasFile('image')) {

            if ($post->image && file_exists(public_path('uploads/posts/' . $post->image))) {
                unlink(public_path('uploads/posts/' . $post->image));
            }

            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('uploads/posts'), $imageName);
            $data['image'] = $imageName;
        }

        $post->update($data);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function trashed()
    {
        $posts = Post::onlyTrashed()->paginate(5);
        return view('posts.trashed', compact('posts'));
    }

    public function restore($id)
    {
        Post::withTrashed()->findOrFail($id)->restore();
        return redirect('/posts')->with('success', 'Post restored successfully');
    }

    public function destroy($id)
    {
        Post::destroy($id);
        return redirect('/posts')->with('success', 'Post deleted successfully');
    }
}
