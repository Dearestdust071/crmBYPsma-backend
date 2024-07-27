<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sancion extends Model
{
    use HasFactory;
    protected $table = "SANCIONES";
    protected $fillable = [
        "personal_fk",
        "usuario_fk",
        "fecha",
        "motivo",
    ];

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_fk');
    }

    public function creador()
    {
        return $this->belongsTo(Usuario::class, 'usuario_fk');
    }
}
