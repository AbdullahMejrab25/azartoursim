<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct()
    {
        return view('errors.403');   
        // Ensure only 'admin' role can access permission management
        // $this->middleware('role:admin');
    }

    public function index()
    {
        // Get all permissions
        $permissions = Permission::all();
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create()
    {
        // Show form to create a new permission
        return view('admin.permissions.create');
    }

    public function store(Request $request)
    {
        // Validate the form input
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);

        // Create a new permission record
        Permission::create([
            'name' => $request->name
        ]);

        // Redirect back with success message
        return redirect()->route('admin.permissions.index')->with('success', 'Permission created successfully.');
    }

    public function edit(Permission $permission)
    {
        // Return the edit form with the existing permission data
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, Permission $permission)
    {
        // Validate form input while excluding current permission from the unique check
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $permission->id,
        ]);

        // Update the permission record
        $permission->update([
            'name' => $request->name,
        ]);

        // Redirect back with success message
        return redirect()->route('admin.permissions.index')->with('success', 'Permission updated successfully.');
    }

    public function destroy(Permission $permission)
    {
        // Delete the permission
        $permission->delete();
        
        // Redirect back with success message
        return redirect()->route('admin.permissions.index')->with('success', 'Permission deleted successfully.');
    }
}
