<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardia extends Model
{
    use HasFactory;


    protected $table = 'GUARDIAS';
    protected $fillable = [
        'dia_semana',
    ];
    public function personal()
    {
        return $this->belongsToMany(Personal::class, 'GUARDIAS_PERSONAL', 'guardia_fk', 'personal_fk');
    }

}
