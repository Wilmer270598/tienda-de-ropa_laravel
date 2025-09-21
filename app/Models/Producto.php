<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'producto';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'descripcion',
        'talla',
        'color',
        'precio',
        'stock_actual',
        'id_categoria',
        'id_temporada',
        'id_proveedor',
    ];

    // Relaciones

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    public function temporada()
    {
        return $this->belongsTo(Temporada::class, 'id_temporada');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}
