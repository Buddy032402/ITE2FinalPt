<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

/**
 * @group Authentication
 *
 * APIs for managing authentication
 */
class AuthController extends Controller
{
    /**
     * Login user
     *
     * @bodyParam email string required The user's email. Example: user@example.com
     * @bodyParam password string required The user's password. Example: password123
     * @bodyParam device_name string required The device name. Example: iPhone 12
     *
     * @response {
     *  "token": "1|abcdef123456",
     *  "user": {
     *    "id": 1,
     *    "name": "John Doe",
     *    "email": "user@example.com"
     *  }
     * }
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return response()->json([
            'token' => $user->createToken($request->device_name)->plainTextToken,
            'user' => $user
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logged out successfully']);
    }
}