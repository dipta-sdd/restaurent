<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'nullable|string|max:255'
        ]);

        // Update user information
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone = $request->phone;
        $user->save();

        // Update or create address
        if ($request->filled('address')) {
            $address = $user->address ?? new Address();
            $address->name = $request->address;
            $address->phone = $request->phone;
            $address->updated_by = $user->id;
            
            if (!$address->exists) {
                $address->created_by = $user->id;
            }
            
            $address->save();
            
            // Associate address with user if it's new
            if (!$user->address) {
                $user->address()->associate($address);
                $user->save();
            }
        }

        return response()->json([
            'message' => 'Profile updated successfully',
            'user' => $user->load('address')
        ]);
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'confirmed', Password::min(6)],
        ]);

        // Check if current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Current password is incorrect'
            ], 422);
        }

        // Update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'message' => 'Password changed successfully'
        ]);
    }
}
