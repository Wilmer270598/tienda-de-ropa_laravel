<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'cliente';
    protected $primaryKey = 'id_cliente';
    public $timestamps = false;

    protected $fillable = [
        'nombre_cliente',
        'apellido_paterno',
        'apellido_materno',
        'telefono',
        'email',
        'direccion',
    ];

    // Relación con ClienteVIP
    public function vip()
    {
        return $this->hasOne(ClienteVIP::class, 'id_cliente');
    }
}
