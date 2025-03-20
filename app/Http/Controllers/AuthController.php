<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterPostRequest;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    /**
     * Register a new user
     *
     * @param RegisterPostRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterPostRequest $request)
    {
        // validate request
        $validated = $request->validated();

        // check if user already exists
        $user = User::where('email', $validated['email'])->first();
        if ($user) {
            return response()->json([
                'message' => 'User already exists',
            ], 400);
        }

        // create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // create token
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], 201);
    }
}
