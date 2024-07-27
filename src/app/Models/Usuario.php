<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Usuario extends Model
{
    use HasFactory;
    use HasApiTokens, Notifiable;

    protected $table = "USUARIOS";

    protected $fillable = [
        "personal_fk",
        "nombre_usuario",
        "contrasena",
    ];

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_fk');
    }

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'ROLES_USUARIOS', 'usuario_fk', 'rol_fk');
    }

    public function actividades()
    {
        return $this->hasMany(Actividad::class, 'creador_fk');
    }

    public function asistencias()
    {
        return $this->hasMany(Asistencia::class, 'encargado_fk');
    }

    public function sanciones()
    {
        return $this->hasMany(Sancion::class, 'creador_fk');
    }

}
