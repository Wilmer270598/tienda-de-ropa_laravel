<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;

class ClienteController extends Controller
{
    public function index(Request $request)
{
    $search = $request->query('search');

    $clientes = Cliente::when($search, function($query, $search) {
        $query->where('nombre_cliente', 'like', "%{$search}%")
              ->orWhere('apellido_paterno', 'like', "%{$search}%")
              ->orWhere('apellido_materno', 'like', "%{$search}%");
    })->get();

    return view('clientes.index', compact('clientes', 'search'));
}

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_cliente' => 'required',
            'apellido_paterno' => 'required',
            'email' => 'required|email|unique:cliente,email',
        ]);

        Cliente::create($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente');
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $request->validate([
            'nombre_cliente' => 'required',
            'apellido_paterno' => 'required',
            'email' => 'required|email|unique:cliente,email,' . $id . ',id_cliente',
        ]);

        $cliente->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente');
    }

    public function destroy($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente');
    }
}
