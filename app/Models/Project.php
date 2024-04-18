<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'other_details',
        'estimated_duration',
        'budget',
        'time_start',
        'image1',
        'image2',
        'image3',
        'image4',
        'file',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_projects');
    }

    public function works()
    {
        return $this->hasMany(Work::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
