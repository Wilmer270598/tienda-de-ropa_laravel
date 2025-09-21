<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::all();
        return view('usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|unique:usuario,nombre',
            'contraseña' => 'required|min:4',
            'nombre_completo' => 'required',
            'id_rol' => 'required|integer',
        ]);

        Usuario::create([
            'nombre' => $request->nombre,
            'contraseña' => Hash::make($request->contraseña),
            'nombre_completo' => $request->nombre_completo,
            'id_rol' => $request->id_rol,
        ]);

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado correctamente');
    }

    public function edit($id)
    {
        $usuario = Usuario::findOrFail($id);
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, $id)
    {
        $usuario = Usuario::findOrFail($id);

        $request->validate([
            'nombre' => 'required|unique:usuario,nombre,' . $id . ',id_usuario',
            'contraseña' => 'nullable|min:4',
            'nombre_completo' => 'required',
            'id_rol' => 'required|integer',
        ]);

        $usuario->nombre = $request->nombre;
        if ($request->contraseña) {
            $usuario->contraseña = Hash::make($request->contraseña);
        }
        $usuario->nombre_completo = $request->nombre_completo;
        $usuario->id_rol = $request->id_rol;
        $usuario->save();

        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado correctamente');
    }

    public function destroy($id)
    {
        $usuario = Usuario::findOrFail($id);
        $usuario->delete();

        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado correctamente');
    }
}
