<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Insurance;

class DashboardController extends Controller
{

    public function index()
    {
        // Get the currently logged-in user
        $user = Auth::user();

        // Check if the user has the "view dashboard" permission
        if (!$user->can('view dashboard')) {
            // Redirect to an unauthorized page or throw an exception
            return view('errors.403');
        }

        // Retrieve the count of roles and permissions
        $totalRoles = Role::count();
        $totalUsers = User::count();
        $totalPermissions = Permission::count();

        $loginCount = $user->loginLogs->count();
        $insuranceCount = $user->activityLogsByUserId($user->id)->count(); 

        // Pass the data to the view
        return view('admin.dashboard', compact('totalRoles', 'totalPermissions','totalUsers', 'loginCount', 'insuranceCount'));
    }


}
