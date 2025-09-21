<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    protected $table = 'proveedor';
    protected $primaryKey = 'id_proveedor';
    public $timestamps = false;

    protected $fillable = [
        'nombre_proveedor',
        'telefono',
        'correo',
        'direccion',
        'rubro_tipoRopa',
        'nit',
        'estado',
        'id_tipoProveedor',
    ];

    // Relación inversa a tipo proveedor
    public function tipoProveedor()
    {
        return $this->belongsTo(TipoProveedor::class, 'id_tipoProveedor');
    }
}
