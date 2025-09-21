<?php

// app/Models/Venta.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'venta';
    protected $primaryKey = 'id_venta';
    public $timestamps = false;

    protected $fillable = ['id_cliente', 'id_usuario', 'fecha', 'total'];

    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }

    public function cliente()
{
    return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
}

public function usuario()
{
    return $this->belongsTo(Usuario::class, 'id_usuario', 'id_usuario');
}
}
