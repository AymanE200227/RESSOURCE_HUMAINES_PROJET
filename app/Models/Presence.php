<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Presence extends Model
{
    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}