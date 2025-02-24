<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Clear cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define Permissions
        $permissions = [
            'view users',
            'create users',
            'edit users',
            'delete users',
            'manage roles',
            'manage permissions',
            'view dashboard', 
            'list permissions',          
            'assign permissions'   
        ];

        // Create and assign permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles and Assign Permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->givePermissionTo([
            'view dashboard',
            'view insurances',     
        ]);

        // Assign Role to Default Users
        $admin = User::where('email', 'admin@example.com')->first();
        if (!$admin) {
            $admin = User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => bcrypt('password'),
            ]);
        }
        $admin->assignRole('admin');

        $user = User::where('email', 'user@example.com')->first();
        if (!$user) {
            $user = User::create([
                'name' => 'Regular User',
                'email' => 'user@example.com',
                'password' => bcrypt('password'),
            ]);
        }
        $user->assignRole('user');

        echo "Roles and Permissions seeded successfully.\n";
    }
}
