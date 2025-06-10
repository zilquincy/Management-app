<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;
use App\Models\Task;

class ProjectSeeder extends Seeder
{
    public function run()
    {
        $admin = User::where('email', 'admin@example.com')->first();
        $pm = User::where('email', 'pm@example.com')->first();
        $member1 = User::where('email', 'member1@example.com')->first();
        $member2 = User::where('email', 'member2@example.com')->first();

        // Create sample project
        $project = Project::create([
            'name' => 'Sample Project Management System',
            'description' => 'A project to build a project management system',
            'status' => 'active',
            'start_date' => now(),
            'end_date' => now()->addDays(30),
            'created_by' => $admin->id
        ]);

        // Assign users to project
        $project->users()->attach([
            $pm->id => ['role' => 'manager'],
            $member1->id => ['role' => 'member'],
            $member2->id => ['role' => 'member']
        ]);

        // Create sample tasks
        Task::create([
            'title' => 'Setup Database Schema',
            'description' => 'Create all necessary database tables',
            'status' => 'done',
            'priority' => 'high',
            'project_id' => $project->id,
            'assigned_to' => $member1->id,
            'created_by' => $pm->id,
            'due_date' => now()->addDays(2)
        ]);

        Task::create([
            'title' => 'Create API Endpoints',
            'description' => 'Build REST API for project management',
            'status' => 'in_progress',
            'priority' => 'high',
            'project_id' => $project->id,
            'assigned_to' => $member2->id,
            'created_by' => $pm->id,
            'due_date' => now()->addDays(5)
        ]);

        Task::create([
            'title' => 'Frontend Development',
            'description' => 'Create Vue.js frontend application',
            'status' => 'todo',
            'priority' => 'medium',
            'project_id' => $project->id,
            'assigned_to' => $member1->id,
            'created_by' => $pm->id,
            'due_date' => now()->addDays(10)
        ]);
    }
}