<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Resources\V1\AuthorResource;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthorController extends Controller
{
    /**
     * List all authors.
     */
    public function index()
    {
        // return response()->json(User::all(), 200);

        $authors = User::all();
        return AuthorResource::collection($authors);
    }

    /**
     * Show details of a specific author.
     */
    public function show(User $user) // Use type hinting for automatic resolution
    {
        return new AuthorResource($user);
    }

    /**
     * List all posts by a specific author.
     */
    public function posts(User $user) // Use type hinting for automatic resolution
    {
        return response()->json($user->posts, 200);
    }
}
