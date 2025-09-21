<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteComun;
use Illuminate\Http\Request;

class ClienteComunController extends Controller
{
    // Mostrar lista de clientes normales
    public function index(Request $request)
    {
        $search = $request->query('search');

        $clientes = ClienteComun::with('cliente')
            ->when($search, function($query, $search) {
                $query->whereHas('cliente', function($q) use ($search) {
                    $q->where('nombre_cliente', 'like', "%{$search}%")
                      ->orWhere('apellido_paterno', 'like', "%{$search}%")
                      ->orWhere('apellido_materno', 'like', "%{$search}%");
                });
            })
            ->get();

        return view('clientes_comunes.index', compact('clientes', 'search'));
    }

    // Mostrar formulario de creación
    public function create()
    {
        return view('clientes_comunes.create');
    }

    // Guardar cliente normal
    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        // Crear cliente principal
        $cliente = Cliente::create([
            'nombre_cliente' => ucfirst(strtolower($request->nombre_cliente)),
            'apellido_paterno' => ucfirst(strtolower($request->apellido_paterno)),
            'apellido_materno' => $request->apellido_materno ? ucfirst(strtolower($request->apellido_materno)) : null,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
        ]);

        // Crear registro en ClienteComun
        ClienteComun::create([
            'id_cliente' => $cliente->id_cliente,
            'fecha_registro' => now(),
        ]);

        return redirect()->route('clientes_comunes.index')->with('success', 'Cliente normal creado correctamente.');
    }

    // Formulario para editar
    public function edit($id)
    {
        $clienteComun = ClienteComun::with('cliente')->findOrFail($id);
        return view('clientes_comunes.edit', compact('clienteComun'));
    }

    // Actualizar cliente normal
    public function update(Request $request, $id)
    {
        $clienteComun = ClienteComun::with('cliente')->findOrFail($id);

        $request->validate([
            'nombre_cliente' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'email' => 'required|email|max:255',
            'direccion' => 'nullable|string|max:255',
        ]);

        $clienteComun->cliente->update([
            'nombre_cliente' => ucfirst(strtolower($request->nombre_cliente)),
            'apellido_paterno' => ucfirst(strtolower($request->apellido_paterno)),
            'apellido_materno' => $request->apellido_materno ? ucfirst(strtolower($request->apellido_materno)) : null,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'direccion' => $request->direccion,
        ]);

        return redirect()->route('clientes_comunes.index')->with('success', 'Cliente normal actualizado correctamente.');
    }

    // Eliminar cliente normal
    public function destroy($id)
    {
        $clienteComun = ClienteComun::findOrFail($id);
        $clienteComun->cliente()->delete(); // elimina el cliente principal
        $clienteComun->delete(); // elimina registro de ClienteComun

        return redirect()->route('clientes_comunes.index')->with('success', 'Cliente normal eliminado correctamente.');
    }
}
