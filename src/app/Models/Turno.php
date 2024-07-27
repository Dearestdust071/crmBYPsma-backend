<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Turno extends Model
{
    use HasFactory;

    protected $table = 'TURNOS';

    protected $fillable = [
        'nombre',
        'hora_inicio',
        'hora_final',
    ];

    public function personal()
    {
        return $this->belongsToMany(Personal::class, 'TURNOS_PERSONAL', 'turno_fk', 'personal_fk');
    }
}
