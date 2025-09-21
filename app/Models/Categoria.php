<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categoria';           // Nombre de la tabla
    protected $primaryKey = 'id_categoria';   // Clave primaria
    public $timestamps = false;               // No usamos timestamps

    protected $fillable = [
        'nombre_categoria',                  // Campos que se pueden asignar masivamente
    ];
}
