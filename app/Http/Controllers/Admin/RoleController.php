<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('role:admin'); // Ensure only admins can access
    }

    public function index()
    {
        // Get all roles
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    public function create()
    {
        // Get all permissions
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        // Validate form input
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
            'permissions' => 'required|array'
        ]);

        // Create a new role
        $role = Role::create(['name' => $request->name]);

        // Convert permission IDs to names
        $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();

        // Assign permissions to the role
        $role->syncPermissions($permissionNames);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        // Get all permissions
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        // Validate form input
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $role->id,
            'permissions' => 'required|array'
        ]);

        // Update role name
        $role->update(['name' => $request->name]);

        // Convert permission IDs to names
        $permissionNames = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();

        // Sync permissions
        $role->syncPermissions($permissionNames);

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        // Remove all assigned permissions before deleting
        $role->permissions()->detach();

        // Delete the role
        $role->delete();

        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
