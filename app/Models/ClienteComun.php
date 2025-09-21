<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClienteComun extends Model
{
    protected $table = 'cliente_comun';
    public $timestamps = false;
    protected $fillable = ['id_cliente', 'fecha_registro'];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }
}

