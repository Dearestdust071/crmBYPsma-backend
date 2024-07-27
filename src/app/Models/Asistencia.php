<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = "ASISTENCIAS";
    protected $fillable = [
        "personal_fk",
        "fecha",
        "presente",
        "chequeo_material",
        "usuario_fk",
    ];

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_fk');
    }

    public function encargado()
    {
        return $this->belongsTo(Usuario::class, 'usuario_fk');
    }

}
