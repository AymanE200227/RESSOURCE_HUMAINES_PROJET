<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['name', 'description', 'start_time', 'end_time','project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('started', 'finished', 'start_time', 'end_time');
    }
    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
    public function assignedUsers()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('started', 'finished', 'start_time', 'end_time');
    }
 
    public function assignedToCurrentUser()
{
return $this->belongsToMany(User::class)
->wherePivot('user_id', auth()->id())
->withPivot('started', 'finished', 'start_time', 'end_time');
}
public function assignedToUser()
{
return $this->belongsTo(User::class, 'assigned_to');
}
}
