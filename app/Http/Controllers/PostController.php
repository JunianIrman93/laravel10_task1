<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Posts::all();

        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|string',
        ]);

        // Insert the data using the Post model
        Posts::create($validated);

        // Redirect or return response after insertion
        return to_route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        // Retrieve the post where id matches the provided $id
        $post = Posts::where('id', $id)->first();

        // Check if the post exists
        if (!$post) {
            return redirect()->back()->with('error', 'Post not found.');
        }

        // Return a view with the post data
        return view('posts.edit', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Posts::find($id);
        // Validate the request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|string',
        ]);

        // Update the data using the Post model
        $post->update($validated);

        // Redirect or return response after insertion
        return to_route('posts.index')->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $deleted = Posts::where('id', $id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Post deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Post not found or could not be deleted.');
        }
    }
}
