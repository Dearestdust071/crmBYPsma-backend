<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = "ACTIVIDADES";
    protected $fillable = [
        "titulo",
        "descripcion",
        "fecha",
        "usuario_fk",
        "personal_fk",
    ];


    public function creador()
    {
        return $this->belongsTo(Usuario::class, 'usuario_fk');
    }

    public function encargado()
    {
        return $this->belongsTo(Personal::class, 'personal_fk');
    }




}
