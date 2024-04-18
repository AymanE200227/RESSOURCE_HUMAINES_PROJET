<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conge extends Model
{
    protected $fillable = [
        '_token', 
        'employee_id',
        'type_conge',
        'date_debut',
        'date_fin',
        'statut',
    ];

    public function employee()
    {
        return $this->belongsTo(User::class);
    }
}
