<?php

use App\Http\Controllers\API\V1\AuthorController;
use App\Http\Controllers\API\V1\PostController;
use App\Http\Controllers\API\V1\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Public routes (no authentication required)
Route::group(['prefix' => 'v1'], function () {
    // User registration
    Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

    // User login
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
});

// Protected routes (requires authentication)
Route::group(
    [
        'prefix' => 'v1',
        'middleware' => 'auth:sanctum',
    ],
    function () {
        // Post CRUD operations
        Route::apiResource('/posts', PostController::class);

        // Get the authenticated user's details
        Route::get('/user', function (Request $request) {
            return $request->user();
        })->name('user.profile');

        // Author-related routes
        Route::get('/authors/{user}', [AuthorController::class, 'show'])->name('authors.show');
        Route::get('/authors/{user}/posts', [AuthorController::class, 'posts'])->name('authors.posts');

        // Logout route
        Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    }
);