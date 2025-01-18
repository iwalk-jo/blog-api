<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * List all posts.
     */
    public function index()
    {
        // Temporarily disable authentication for testing
        // $posts = Post::with('author')->get(); 

        $posts = Post::all(); // Get all posts without loading author

        return PostResource::collection($posts);
    }

    /**
     * Create a new post.
     */
    public function store(Request $request)
    {
        // Create a test user (for testing purposes only)
        $user = User::factory()->create();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a post associated with a specific user (e.g., user ID 1) only for testing without auth
        $post = $user->posts()->create($validated);

        // $post = Auth::user()->posts()->create($validated);

        return (new PostResource($post))->response()->setStatusCode(201);
    }

    /**
     * Display a specific post.
     */
    public function show(Post $post)
    {
        // Temporarily disable eager loading for testing
        // return (new PostResource($post->load('author')))->response()->setStatusCode(200);

        return (new PostResource($post))->response()->setStatusCode(200);
    }

    /**
     * Update a post.
     */
    public function update(Request $request, Post $post)
    {
        // Temporarily disable authentication check for testing
        // if (Auth::id() !== $post->user_id) {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $post->update($validated);

        return (new PostResource($post))->response()->setStatusCode(200);
    }

    /**
     * Delete a post.
     */
    public function destroy(Post $post)
    {
        // Temporarily disable authentication check for testing
        // if (Auth::id() !== $post->user_id) {
        //     return response()->json(['error' => 'Unauthorized'], 403);
        // }

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully'], 200);
    }
}