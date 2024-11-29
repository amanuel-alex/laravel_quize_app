<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $admin = Role::create(['name' => 'admin']);
        $user = Role::create(['name' => 'user']);

        // Create permissions
        Permission::create(['name' => 'add question']);
        Permission::create(['name' => 'edit question']);
        Permission::create(['name' => 'delete question']);
        Permission::create(['name' => 'view question']);
        Permission::create(['name' => 'add quiz']);
        Permission::create(['name' => 'view quiz']);
        Permission::create(['name' => 'comment on quiz']);

        // Assign permissions to roles
        $admin->givePermissionTo('add question', 'edit question', 'delete question', 'add quiz');
        $user->givePermissionTo('view quiz', 'comment on quiz');

        // Optionally, you can assign roles to users here
        $adminUser = \App\Models\User::first();
        if ($adminUser) {
            $adminUser->assignRole('admin');
        }
    }
}
