<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    /**
     * Controller Function for Register
     **/
    public function register(StoreRegisterRequest $request): JsonResponse
    {
        $user = User::create([
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Registration successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user,
        ], Response::HTTP_CREATED);
    }

    /**
     * Controller Function for Login
     **/
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required|min:8',
        ]);

        if (!Auth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = User::where('email', $request->email)->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Login successful',
            'access_token' => $token,
            'token_type' => 'Bearer',
        ], Response::HTTP_OK);
    }

    /**
     * Controller Function for Logout
     **/
    public function logout(Request $request): JsonResponse
    {
        Auth::user()->tokens()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Logout successful'
        ], Response::HTTP_OK);
    }

}
