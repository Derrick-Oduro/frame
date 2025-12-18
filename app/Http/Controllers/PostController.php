<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->can('view posts')) {
            abort(403, 'Unauthorized action.');
        }
        $posts = Post::all();

        return view("admin.post", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->can('create posts')) {
            abort(403, 'Unauthorized action.');
        }
        return view("components.modal.createPostModal");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         if (!auth()->user()->can('create posts')) {
            abort(403, 'Unauthorized action.');
        }
        $validateData= $request->validate([
            "title" => "required|string|max:255",
            "category_id" => "required|exists:categories,id",
            "body" => "required|string",
        ]);

        Post::create([
            "title" => $validateData["title"],
            "category_id"=> $validateData["category_id"],
            "body"=> $validateData["body"],
            "user_id"=> auth()->id(),
        ]);
        return redirect()->route("posts.index")->with("success","Post created successfully.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        if (!auth()->user()->can('update', $post)) {
        abort(403);
    }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        if (!auth()->user()->can('update', $post)) {
        abort(403);
        }

        $validateData= $request->validate([
            "title" => "required|string|max:255",
            "category_id" => "required|exists:categories,id",
            "body" => "required|string",
        ]);
        $post->update([
            "title" => $validateData["title"],
            "category_id"=> $validateData["category_id"],
            "body"=> $validateData["body"],
        ]);
        return redirect()->route("posts.index")->with("success","Post updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        if (!auth()->user()->can('delete', $post)) {
        abort(403);
        }
        $post->delete();
        return redirect()->route("posts.index")->with("success","Post deleted successfully.");
    }
}
