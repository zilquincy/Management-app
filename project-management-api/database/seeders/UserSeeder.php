<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Create project manager
        User::create([
            'name' => 'Project Manager',
            'email' => 'pm@example.com',
            'password' => Hash::make('password'),
            'role' => 'project_manager'
        ]);

        // Create team members
        User::create([
            'name' => 'Team Member 1',
            'email' => 'member1@example.com',
            'password' => Hash::make('password'),
            'role' => 'team_member'
        ]);

        User::create([
            'name' => 'Team Member 2',
            'email' => 'member2@example.com',
            'password' => Hash::make('password'),
            'role' => 'team_member'
        ]);
    }
}