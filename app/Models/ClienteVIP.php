<?php

// app/Models/ClienteVIP.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteVIP extends Model
{
    protected $table = 'ClienteVIP';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;
    protected $fillable = ['id_cliente', 'nivel_vip', 'porcentaje_descuento', 'fecha_ingreso'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id_cliente');
    }
}

