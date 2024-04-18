<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'create-role',
            'edit-role',
            'delete-role',
            'create-user',
            'edit-user',
            'delete-user',
            'create-post', 
            'edit-post',   
            'delete-post', 
            'request-leave', 
            'manage-leave',
            'manage-evaluations', 
            'manage-presence',
            'manage-projects',
            'manage-works',
            'do-tasks',
            'manage-tasks',
             
        ];

        
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
