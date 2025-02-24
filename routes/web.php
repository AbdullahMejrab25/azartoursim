<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{InsuranceController, ListValueController};

Route::get('/phpinfo', function () {
    phpinfo();
});



// Authentication and Profile Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Admin Routes (Protected by 'auth' only)
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Activity
    // Route::get('users/activity', [UserController::class, 'userActivity'])->name('useractivity');

    // Resource Routes for Users, Roles, and Permissions
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

});


// Redirect to login if not authenticated
Route::get('/', function () {
    return redirect()->route('login');
});


require __DIR__.'/auth.php';
