<?php

use App\Http\Controllers\API\V1\AuthorController;
use App\Http\Controllers\API\V1\PostController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Resources\V1\PostCollection;
use Illuminate\Http\Request;
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

Route::group(
    [
        'prefix' => 'v1',
        'middleware' => 'auth:sanctum'
    ],
    function () {
        // Posts
        // Route::apiResource('/posts', PostCollection::class); 
        Route::apiResource('/posts', PostController::class);

        // Authors
        Route::get('/authors/{user}', [AuthorController::class, 'show'])->name('authors.show');
        Route::get('/authors/{user}/posts', [AuthorController::class, 'posts']);

        Route::post('/login', [AuthenticatedSessionController::class, 'store'])
            ->middleware('guest')
            ->name('login');

    }

);

// Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
//     return $request->user();
// });
