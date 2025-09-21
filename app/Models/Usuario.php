<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Rol;


class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuario'; // Tu tabla real

    protected $primaryKey = 'id_usuario'; // PK

    public $timestamps = false; // porque tu tabla no usa created_at ni updated_at

    protected $fillable = [
        'nombre',
        'contraseña',
        'nombre_completo',
        'id_rol',
    ];

    protected $hidden = [
        'contraseña',
    ];

    // Laravel espera "password", aquí hacemos que use "contraseña"
    public function getAuthPassword()
    {
        return $this->contraseña;
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'id_rol', 'id_rol');
    }
}
