<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    protected $fillable = [
        'employee_id',
        'criteria',
    ];

    protected $casts = [
        'criteria' => 'array',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
