<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Fetching all posts
        $posts = Post::all();

        // Fetching category names and count of posts for each category
        $categories = Category::withCount('posts')->get();

        // Prepare data for the chart
        $categoryNames = $categories->pluck('category_name');
        $postCounts = $categories->pluck('posts_count');

        return view('posts.index', compact('posts', 'categoryNames', 'postCounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $categories = Category::all();

        return view('posts.create', compact('categories'));
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
        Post::create($validated);

        // Redirect or return response after insertion
        return to_route('posts.index')->with('success', 'Post created successfully!');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Post $post)
    public function show(string $id)
    {
        //
        $post = Post::find($id);

        $categories = Category::all();

        // Return a view with the post data
        return view('posts.show', compact('post', 'categories'));
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
        $post = Post::find($id);
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
        $deleted = Post::where('id', $id)->delete();

        if ($deleted) {
            return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
        } else {
            return redirect()->back()->with('error', 'Post not found or could not be deleted.');
        }
    }
}
