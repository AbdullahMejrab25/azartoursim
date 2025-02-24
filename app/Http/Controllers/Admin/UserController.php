<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin');
    }

    public function userActivity()
    {
        // Fetch all users with their login logs and activity logs
        $users = User::with(['loginLogs', 'activityLogs'])->get();

        // Calculate total policies created and total logins for each user
        foreach ($users as $user) {
            $user->total_policies = $user->activityLogs->count();
            $user->total_logins = $user->loginLogs->count();

            // Get the last 3 login dates (if available)
            $user->last_logins = $user->loginLogs()
                ->orderBy('created_at', 'desc')
                ->take(3)
                ->pluck('created_at');
        }
        return view('admin.users.useractivity', compact('users'));
    }

    
    public function index()
    {
        // Get all users
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        // Get all roles
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'roles' => 'required|array' // Ensure this is an array of valid role IDs
        ]);

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Validate that all role IDs exist
        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();

        // Ensure roles exist before assigning
        if (count($roleNames) !== count($request->roles)) {
            return redirect()->back()->with('error', 'One or more roles do not exist.');
        }

        // Assign roles to user
        $user->assignRole($roleNames);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully.');
    }

    public function update(Request $request, User $user)
    {
        // Validate form input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'roles' => 'required|array' // Ensure this is an array of valid role IDs
        ]);

        // Update user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Validate that all role IDs exist
        $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();

        // Ensure roles exist before syncing
        if (count($roleNames) !== count($request->roles)) {
            return redirect()->back()->with('error', 'One or more roles do not exist.');
        }

        // Sync roles
        $user->syncRoles($roleNames);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }


    public function edit(User $user)
    {
        // Get all roles
        $roles = Role::all();
        // Pass the user and roles to the view
        return view('admin.users.edit', compact('user', 'roles'));
    }

    public function destroy(User $user)
    {
        // Ensure the user doesn't delete themselves (optional but recommended)
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'You cannot delete your own account.');
        }

        // Delete the user
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully.');
    }
}
