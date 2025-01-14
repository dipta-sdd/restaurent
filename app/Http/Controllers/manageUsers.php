<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class manageUsers extends Controller
{
    private function getAllowedRoles()
    {
        $user = auth()->user();
        
        if ($user->is_admin()) {
            return ['manager', 'staff', 'rider', 'user'];
        } elseif ($user->role === 'manager') {
            return ['staff', 'rider', 'user'];
        } elseif ($user->role === 'staff') {
            return ['rider'];
        }
        return [];
    }

    public function adminUsers(Request $request)
    {
        $role = $request->query('role');
        $allowedRoles = $this->getAllowedRoles();
        
        $query = User::selectRaw('users.*, 
            CONCAT(creator.first_name, " ", creator.last_name) as creator_name,
            CONCAT(updater.first_name, " ", updater.last_name) as updater_name')
            ->leftJoin('users as creator', 'users.created_by', '=', 'creator.id')
            ->leftJoin('users as updater', 'users.updated_by', '=', 'updater.id');

        // Filter by role if specified
        if ($role) {
            if (!in_array($role, $allowedRoles)) {
                abort(403, 'You are not authorized to view users with this role');
            }
            $query->where('users.role', $role);
        } else {
            // If no specific role is requested, show all allowed roles
            $query->whereIn('users.role', $allowedRoles);
        }

        $users = $query->orderBy('users.created_at', 'desc')->get();

        // Only show role options that the current user can manage
        $roles = [];
        if (in_array('manager', $allowedRoles)) $roles['manager'] = 'Manager';
        if (in_array('staff', $allowedRoles)) $roles['staff'] = 'Staff';
        if (in_array('rider', $allowedRoles)) $roles['rider'] = 'Rider';
        if (in_array('user', $allowedRoles)) $roles['user'] = 'Customer';

        return view('admin.users', [
            'users' => $users,
            'roles' => $roles,
            'currentUserRole' => auth()->user()->role
        ]);
    }

    public function addUser(Request $request)
    {
        $allowedRoles = $this->getAllowedRoles();

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'role' => 'required|in:' . implode(',', $allowedRoles),
            'password' => 'required|min:6',
            'status' => 'required|in:active,inactive'
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['created_by'] = auth()->id();
        $data['updated_by'] = auth()->id();

        $user = User::create($data);
        $user->status = $data['status'];
        $user->save();

        // Get creator and updater names for response
        $creator = User::find($user->created_by);
        $updater = User::find($user->updated_by);

        $user->creator_name = $creator ? $creator->first_name . ' ' . $creator->last_name : 'N/A';
        $user->updater_name = $updater ? $updater->first_name . ' ' . $updater->last_name : 'N/A';

        // Add role display name to response
        $roles = [
            'manager' => 'Manager',
            'staff' => 'Staff',
            'rider' => 'Rider',
            'user' => 'Customer'
        ];
        $user->role_display = $roles[$user->role] ?? ucfirst($user->role);

        return response()->json([
            'user' => $user,
            'status' => $user->status,
            'role_display' => $user->role_display
        ], 201);
    }

    public function updateUser(Request $request, $id)
    {
        $allowedRoles = $this->getAllowedRoles();
        $user = User::findOrFail($id);

        // Check if user has permission to edit this role
        if (!in_array($user->role, $allowedRoles)) {
            return response()->json(['message' => 'You are not authorized to edit this user'], 403);
        }

        $data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'required|string|max:20',
            'role' => 'required|in:' . implode(',', $allowedRoles),
            'status' => 'required|in:active,inactive',
            'password' => 'nullable|min:6'
        ]);

        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['updated_by'] = auth()->id();
        // dd(json_encode($data));
        $user->update($data);
        $user->status = $data['status'];
        $user->save();

        // Refresh user data
        // $user = User::find($id);

        // Get creator and updater names for response
        $creator = User::find($user->created_by);
        $updater = User::find($user->updated_by);

        $user->creator_name = $creator ? $creator->first_name . ' ' . $creator->last_name : 'N/A';
        $user->updater_name = $updater ? $updater->first_name . ' ' . $updater->last_name : 'N/A';

        // Add role display name to response
        $roles = [
            'manager' => 'Manager',
            'staff' => 'Staff',
            'rider' => 'Rider',
            'user' => 'Customer'
        ];
        $user->role_display = $roles[$user->role] ?? ucfirst($user->role);

        return response()->json([
            'user' => $user,
            'status' => $user->status,
            'role_display' => $user->role_display
        ]);
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $allowedRoles = $this->getAllowedRoles();
        
        // Check if user has permission to delete this role
        if (!in_array($user->role, $allowedRoles)) {
            return response()->json(['message' => 'You are not authorized to delete this user'], 403);
        }
        
        // Prevent deleting yourself
        if ($user->id === auth()->id()) {
            return response()->json(['message' => 'You cannot delete your own account'], 403);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function filterUsers(Request $request)
    {
        $role = $request->input('role');
        $allowedRoles = $this->getAllowedRoles();

        $query = User::selectRaw('users.*, 
            CONCAT(creator.first_name, " ", creator.last_name) as creator_name,
            CONCAT(updater.first_name, " ", updater.last_name) as updater_name')
            ->leftJoin('users as creator', 'users.created_by', '=', 'creator.id')
            ->leftJoin('users as updater', 'users.updated_by', '=', 'updater.id');

        if ($role) {
            if (!in_array($role, $allowedRoles)) {
                return response()->json(['message' => 'You are not authorized to view users with this role'], 403);
            }
            $query->where('users.role', $role);
        } else {
            $query->whereIn('users.role', $allowedRoles);
        }

        $users = $query->orderBy('users.created_at', 'desc')->get();

        // Add role display names to response
        $roles = [
            'manager' => 'Manager',
            'staff' => 'Staff',
            'rider' => 'Rider',
            'user' => 'Customer'
        ];

        foreach ($users as $user) {
            $user->role_display = $roles[$user->role] ?? ucfirst($user->role);
        }

        return response()->json([
            'users' => $users,
            'currentUserRole' => auth()->user()->role
        ]);
    }
} 