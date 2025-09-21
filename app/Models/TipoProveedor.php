<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoProveedor extends Model
{
    use HasFactory;

    protected $table = 'tipo_proveedor';
    protected $primaryKey = 'id_tipoProveedor';
    public $timestamps = false;

    protected $fillable = [
        'nombre_tipoProveedor',
    ];

    // Relación uno a muchos con proveedor
    public function proveedores()
    {
        return $this->hasMany(Proveedor::class, 'id_tipoProveedor');
    }
}
