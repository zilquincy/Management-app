<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'start_date',
        'end_date',
        'created_by',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    // Relationships
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user')
                    ->withPivot('role')
                    ->withTimestamps();
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    // Helper Methods untuk mendapatkan tasks berdasarkan status
    public function todoTasks()
    {
        return $this->tasks()->where('status', 'todo');
    }

    public function inProgressTasks()
    {
        return $this->tasks()->where('status', 'in_progress');
    }

    public function doneTasks()
    {
        return $this->tasks()->where('status', 'done');
    }

    // Get project managers
    public function managers()
    {
        return $this->users()->wherePivot('role', 'manager');
    }

    // Get project members
    public function members()
    {
        return $this->users()->wherePivot('role', 'member');
    }

    // Check if user is member of this project
    public function hasMember($userId)
    {
        return $this->users()->where('user_id', $userId)->exists();
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }
}