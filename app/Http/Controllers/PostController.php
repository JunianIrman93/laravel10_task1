<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // Fetching all posts along with related tags and category
        $posts = Post::with('tags', 'category')->get();

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

        $categories = Category::all(); // Fetching all categories

        $allTags = Tag::all(); // Fetching all tags

        return view('posts.create', compact('categories', 'allTags'));
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
            'tags' => 'array',
            'tags.*' => 'string|max:255',
        ]);

        // Insert the data using the Post model
        $post = Post::create($validated);

        // Proses tags
        if (isset($validated['tags'])) {
            $tagIds = [];
            foreach ($validated['tags'] as $tagName) {
                $tag = Tag::firstOrCreate(['name' => $tagName]);
                $tagIds[] = $tag->id;
            }
            // Attach tags ke post
            $post->tags()->attach($tagIds);
        }

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
        $post = Post::with('tags', 'category')->find($id);

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

    public function update(Request $request, string $id)
    {
        // Validasi data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category_id' => 'required|integer|exists:categories,id',
            'tags' => 'nullable|array',
            'tags.*' => 'string|max:255', // Mengizinkan ID (sebagai string) atau nama tag
        ]);

        // Fetch the post
        $post = Post::findOrFail($id);

        // Update the post data
        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'category_id' => $validated['category_id'],
        ]);

        // Handle tags
        if (isset($validated['tags'])) {
            $tagIds = [];

            foreach ($validated['tags'] as $tagInput) {

                if (is_numeric($tagInput)) {
                    // Jika input adalah ID tag yang sudah ada
                    $tag = Tag::find($tagInput);
                    if ($tag) {
                        $tagIds[] = $tag->id;
                    } else {
                        $newTag = Tag::firstOrCreate(['name' => trim($tagInput)]);
                        $tagIds[] = $newTag->id;
                    }
                } else {
                    // Jika input adalah nama tag baru
                    $tag = Tag::firstOrCreate(['name' => trim($tagInput)]);
                    $tagIds[] = $tag->id;
                }
            }

            // Sinkronkan tags ke post
            $post->tags()->sync($tagIds);
        } else {
            // Jika tidak ada tags, detach semua tags yang ada
            $post->tags()->detach();
        }

        // Redirect setelah pembaruan
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
