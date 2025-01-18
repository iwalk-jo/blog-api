<?php

namespace App\Http\Controllers;

use App\Http\Resources\v1\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * List all posts.
     */
    public function index()
    {
        // return response()->json(Post::all(), 200);
        return new PostCollection(Post::all());
    }

    /**
     * Create a new post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Auth::user()->posts()->create($validated);

        return response()->json($post, 201);
    }

    /**
     * Display a specific post.
     */
    public function show($id)
    {
        $post = Post::findOrFail($id);
        return response()->json($post, 200);
    }

    /**
     * Update a post.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $post->update($validated);

        return response()->json($post, 200);
    }

    /**
     * Delete a post.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (Auth::id() !== $post->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}
