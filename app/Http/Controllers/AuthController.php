<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|string|max:15|unique:users',
            'role' => 'required|string|max:50',
            'email' => 'required_without:phone', // Email is required if phone is not present
            'phone' => 'required_without:email', 
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'role' => $request->role,
            'created_by' => null, // Set as needed
            'updated_by' => null, // Set as needed
        ]);

        // Generate JWT token
        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'), 201);
    }
    public function currentUser(Request $request)
    {
        // Get the authenticated user
        $user = JWTAuth::parseToken()->authenticate();

        // Return the user data
        return response()->json($user);
    }
    public function login(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'nullable|string|email',
            'phone' => 'nullable|string|email',
            'password' => 'required|string',
            'email' => 'required_without:phone', // Email is required if phone is not present
            'phone' => 'required_without:email', 
            
        ]);

        // Get the credentials
        $credentials = $request->only('email', 'password');

        try {
            // Attempt to verify the credentials and create a token for the user
            if (!$token = JWTAuth::attempt($credentials)) { 
                $credentials = $request->only('phone', 'password');
                if (!$token = JWTAuth::attempt($credentials)) { 
                    return response()->json(['error' => 'Unauthorized'], 401);
                }
                
                $user = User::where('phone', $request->phone)->first();
                return response()->json(compact('user', 'token'));
            }
            $user = User::where('phone', $request->phone)->first();
                return response()->json(compact('user', 'token'));

        } catch (JWTException $e) {
            return response()->json(['error' => 'Could not create token'], 500);
        }

        // Return the token and user data
    }
}