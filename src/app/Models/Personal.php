<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    use HasFactory;


    protected $table = "PERSONAL";

    protected $fillable = [
        "nombre",
        "apellido_paterno",
        "apellido_materno",
        "numero_telefono",
    ];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'ROLES_PERSONAL', 'personal_fk', 'rol_fk');
    }

    public function guardias()
    {
        return $this->belongsToMany(Guardia::class, 'GUARDIAS_PERSONAL', 'personal_fk', 'guardia_fk');
    }

    public function turnos()
    {
        return $this->belongsToMany(Turno::class, 'TURNOS_PERSONAL', 'personal_fk', 'turno_fk');
    }


}
