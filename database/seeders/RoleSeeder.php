<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'Admin']);
        $Gestionnaire_RH  = Role::create(['name' => 'Gestionnaire RH']);
        $employee  = Role::create(['name' => 'employee']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-post',
            'edit-post',
            'delete-post',
            'manage-leave',
            'manage-evaluations',
            'manage-presence',
        ]);

        $Gestionnaire_RH ->givePermissionTo([
            'create-post',
            'edit-post',
            'delete-post',
            'manage-leave',
            'manage-evaluations',
            'manage-presence',
            'manage-projects',
            'manage-tasks',
            'manage-works',
        ]);

        $employee ->givePermissionTo([
            'create-post',
            'edit-post',
            'delete-post',
            'request-leave',
            'manage-presence',
            'do-tasks',
        ]);
    }
}
