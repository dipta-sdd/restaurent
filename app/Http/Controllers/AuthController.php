<?php

namespace App\Http\Controllers;

use App\Http\Requests\SignupValidetor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    public function signup(SignupValidetor $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        return response()->json(['message' => 'User created successfully', 'user' => $user], 201);
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

            return response()->json([
                'user' => $user
            ]);
        } else {
            $credentials = $request->only('phone', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user = Auth::user();

                return response()->json([
                    'user' => $user
                ]);
            }
            return response()->json(['error' => 'Unauthorized'], 401);
        }
    }
    public function logout(Request $request)
    {
        // $request->user()->tokens()->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');

        return response()->json(['message' => 'Logged out']);
    }
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
    public function verification(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            if ($user->otp_exp) {
                $timeLeft = (int)now()->diffInSeconds(Carbon::parse($user->otp_exp));
                // dd($timeLeft);
                if ($timeLeft > 180) {
                    return view('/otp_verification', ['timeLeft' => $timeLeft]);
                }
            }
            $otp = rand(122454, 999999);
            $user->otp = $otp;
            // call otp send function here
            $user->otp_exp = now()->addMinutes(5);
            $user->save();
            $timeLeft =
                (int)now()->diffInSeconds(Carbon::parse($user->otp_exp));
            return view('/otp_verification', ['timeLeft' => $timeLeft]);
        } else {
            redirect('/login');
        }
    }

    public function verifyOtp(Request $request)
    {
        $user = Auth::user();

        $timeLeft =
            (int)now()->diffInSeconds(Carbon::parse($user->otp_exp));
        if ($timeLeft > 0) {
            if ($user->otp == $request->otp) {
                $user->otp = null;
                $user->otp_exp = null;
                $user->verified_at = now();
                $user->status = 'active';
                $user->save();
                return response()->json(['message' => 'Otp verified successfully']);
            } else {
                return response()->json(['error' => 'Otp does not match'], 401);
            }
        } else {
            return response()->json(['error' => 'Otp expired'], 401);
        }
    }

    public function redirectToGoogle()
    {
        try {
            // Log all Google-related configuration
            \Log::info('Google OAuth Config:', [
                'client_id' => config('services.google.client_id'),
                'client_secret' => config('services.google.client_secret'),
                'redirect' => config('services.google.redirect'),
                'env_client_id' => env('GOOGLE_CLIENT_ID'),
                'env_client_secret' => env('GOOGLE_CLIENT_SECRET'),
                'env_redirect' => env('GOOGLE_REDIRECT_URI')
            ]);
            
            return Socialite::driver('google')
                ->stateless()
                ->with(['prompt' => 'select_account'])
                ->redirect();
        } catch (\Exception $e) {
            \Log::error('Google OAuth Error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return redirect('/login')->with('error', 'Could not connect to Google. Please try again.');
        }
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            
            $user = User::where('google_id', $googleUser->id)->first();

            if (!$user) {
                // Check if user exists with same email
                $user = User::where('email', $googleUser->email)->first();
                
                if (!$user) {
                    // Create new user
                    $user = User::create([
                        'first_name' => explode(' ', $googleUser->name)[0],
                        'last_name' => isset(explode(' ', $googleUser->name)[1]) ? explode(' ', $googleUser->name)[1] : '',
                        'email' => $googleUser->email,
                        'google_id' => $googleUser->id,
                        'status' => 'active',
                        'verified_at' => now()
                    ]);
                } else {
                    // Update existing user with google_id
                    $user->google_id = $googleUser->id;
                    $user->save();
                }
            }

            Auth::login($user);
            
            if ($user->role === 'admin') {
                return redirect('/admin/dashboard');
            }
            return redirect('/');

        } catch (\Exception $e) {
            \Log::error('Google Callback Error: ' . $e->getMessage());
            \Log::error($e->getTraceAsString());
            return redirect('/login')->with('error', 'Something went wrong with Google login. Please try again.');
        }
    }
}
