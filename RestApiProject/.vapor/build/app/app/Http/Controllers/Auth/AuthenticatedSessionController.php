<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            // Validate the request data
            $request->validate([
                'email' => ['required', 'string', 'email'],
                'password' => ['required', 'string'],
            ]);

            // Attempt authentication
            if (!Auth::attempt($request->only('email', 'password'))) {
                throw ValidationException::withMessages([
                    'email' => ['Invalid credentials.'],
                ]);
            }

            // Retrieve authenticated user
            $user = Auth::user();

            // Create a Sanctum token
            $token = $user->createToken('authToken')->plainTextToken;

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                    ],
                    'token' => $token,
                ],
                'message' => 'User logged in successfully',
            ], 200); // 200 OK
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
                'errors' => $e->errors(),
            ], 422); // 422 Unprocessable Entity
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500); // 500 Internal Server Error
        }
    }
}