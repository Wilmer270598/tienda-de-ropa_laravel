<?php

namespace App\Http\Controllers;

use App\Models\Usuario; // Ajustá al modelo real que uses
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all(); // traemos usuarios
        return view('permisos.index', compact('usuarios'));
    }
}
