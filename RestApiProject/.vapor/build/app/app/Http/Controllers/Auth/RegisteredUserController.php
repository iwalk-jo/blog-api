<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        // debugging
        Log::info('Registration request data:', $request->all());

        try {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed', 'min:8'], // Ensure 'password_confirmation' exists
            ]);

            // $request->validate([
            //     'name' => ['required', 'string', 'max:255'],
            //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            //     'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            event(new Registered($user));

            return response()->json([
                'status' => 'success',
                'message' => 'User registered successfully.',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            Log::error('Registration failed:', ['error' => $e->getMessage()]);
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to register user.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
