<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    use HasFactory;

    protected $table = 'inventario';
    protected $primaryKey = 'id_inventario';
    public $timestamps = false; // ya usamos fecha manualmente

    protected $fillable = [
        'id_producto',
        'tipo_movimiento',
        'cantidad',
        'fecha',
        'observacion',
        'id_usuario'
    ];

    // Relaciones
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }

    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
    }
}
