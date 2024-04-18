<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Creating Super Admin User
        $superAdmin = User::create([
            'name' => 'Aymane dev', 
            'email' => 'ayman@gmail.com',
            'password' => Hash::make('Password')
        ]);
        $superAdmin->assignRole('Super Admin');

        // Creating Admin User
        $admin = User::create([
            'name' => 'ahmad', 
            'email' => 'ahmad@gmail.com',
            'password' => Hash::make('Password')
        ]);
        $admin->assignRole('employee');

          
    }
}