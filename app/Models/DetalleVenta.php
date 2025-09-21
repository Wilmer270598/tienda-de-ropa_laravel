<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalle_venta';
    protected $primaryKey = 'id_detalleVenta';
    public $timestamps = false;

    protected $fillable = [
        'id_venta',
        'id_producto',
        'cantidad',
        'precio_unitario',
        'descuento_aplicado',
        'subtotal'
    ];

    // Relación con la venta
    public function venta()
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
