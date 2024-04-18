<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function conges(): HasMany
    {
        return $this->hasMany(Conge::class, 'employee_id');
    }

    public function evaluations(): HasMany
    {
        return $this->hasMany(Evaluation::class, 'employee_id');
    }

    public function presences(): HasMany
    {
        return $this->hasMany(Presence::class, 'employee_id');
    }

    // Define the assignedTasks relationship without pivot table attributes
    public function assignedTasks(): BelongsToMany
{
    return $this->belongsToMany(Task::class, 'task_user', 'user_id', 'task_id')
        ->withPivot('started', 'finished', 'start_time', 'end_time')
        ->withTimestamps();
}


    public function workSchedule()
    {
        return $this->hasOne(User::class);
    }

    public function leaveBalance(): int
    {
        $totalLeaveEarned = $this->leave_balance ?? 0;
        $totalLeaveTaken = $this->conges()->where('status', 'approved')->sum('number_of_days');
        $leaveBalance = $totalLeaveEarned - $totalLeaveTaken;
        return $leaveBalance;
    }

    public function isConnectedToProject(Project $project)
    {
        return $this->projects->contains($project);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class, 'user_projects');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withPivot('started', 'finished', 'start_time', 'end_time');
    }
    public function assignedToCurrentUser()
    {
        return $this->belongsToMany(Task::class, 'task_user')
            ->wherePivot('user_id', auth()->id());
    }
    
}
