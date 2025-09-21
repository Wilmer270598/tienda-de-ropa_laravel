<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    use HasFactory;

    protected $table = 'temporada';           // Nombre de la tabla
    protected $primaryKey = 'id_temporada';   // Clave primaria
    public $timestamps = false;               // No usamos timestamps

    protected $fillable = [
        'nombre_temporada',                  // Campos que se pueden asignar masivamente
    ];
}
