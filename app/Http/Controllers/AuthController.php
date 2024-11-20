<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupValidetor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;


class AuthController extends Controller
{
    public function signup(SignupValidetor $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

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

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();

            $token = $user->createToken('api-token')->accessToken; // Generate token for both

            return response()->json([
                'user' => $user,
                'token' => $token
            ]);
        } else {
            $credentials = $request->only('phone', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = Auth::user();
                // dd(json_encode($user));
                $token = $user->createToken('api-token')->accessToken;

                return response()->json([
                    'user' => $user,
                    'token' => $token
                ]);
            }
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
}
