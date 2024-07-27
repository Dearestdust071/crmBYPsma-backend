<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    use HasFactory;

    protected $table = "ROLES";
    
    protected $fillable = [
        "nombre"
    ];

    public function usuarios()
    {
        return $this->belongsToMany(Usuario::class, 'ROLES_USUARIOS', 'rol_fk', 'usuario_fk');
    }

    public function personal()
    {
        return $this->belongsToMany(Personal::class, 'ROLES_PERSONAL', 'rol_fk', 'personal_fk');
    }

}
