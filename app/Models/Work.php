<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = ['user_id', 'project_id', 'start', 'hours', 'work_done', 'rate', 'ip_address_start', 'ip_address_end'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}