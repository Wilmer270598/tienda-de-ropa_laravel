<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ClienteVIP;
use Illuminate\Http\Request;

class ClienteVIPController extends Controller
{
    // Mostrar lista de clientes VIP
    public function index(Request $request)
    {
        $search = $request->query('search');

        $clientes = ClienteVIP::with('cliente')
            ->when($search, function($query, $search) {
                $query->whereHas('cliente', function($q) use ($search) {
                    $q->where('nombre_cliente', 'like', "%{$search}%")
                      ->orWhere('apellido_paterno', 'like', "%{$search}%")
                      ->orWhere('apellido_materno', 'like', "%{$search}%");
                });
            })
            ->get();

        return view('clientes_vip.index', compact('clientes', 'search'));
    }

    // Crear VIP manualmente NO permitido
    public function create()
    {
        abort(403, 'No se permite crear Cliente VIP manualmente.');
    }

    // Guardar ascenso a VIP (si se llama desde un formulario, opcional)
    public function store(Request $request)
    {
        ClienteVIP::create([
            'id_cliente' => $request->id_cliente,
            'nivel_vip' => $request->nivel_vip,
            'porcentaje_descuento' => $request->porcentaje_descuento,
            'fecha_ingreso' => $request->fecha_ingreso ?? now(),
        ]);

        return redirect()->route('clientes.index')->with('success', 'Cliente ascendido a VIP correctamente.');
    }

    // Formulario para editar cliente VIP
    public function edit($id)
    {
        $clienteVIP = ClienteVIP::with('cliente')->findOrFail($id);
        return view('clientes_vip.edit', compact('clienteVIP'));
    }

    // Actualizar cliente VIP
    public function update(Request $request, $id)
    {
        $clienteVIP = ClienteVIP::with('cliente')->findOrFail($id);

        $request->validate([
            'nivel_vip' => 'required|string|max:50',
            'porcentaje_descuento' => 'required|numeric|min:0|max:100',
        ]);

        $clienteVIP->update([
            'nivel_vip' => $request->nivel_vip,
            'porcentaje_descuento' => $request->porcentaje_descuento,
        ]);

        return redirect()->route('clientes_vip.index')->with('success', 'Cliente VIP actualizado correctamente.');
    }

    // Eliminar cliente VIP (sin eliminar cliente base)
    public function destroy($id)
    {
        $clienteVIP = ClienteVIP::findOrFail($id);
        $clienteVIP->delete();

        return redirect()->route('clientes_vip.index')->with('success', 'Cliente VIP eliminado correctamente.');
    }

    // Ascender cliente a VIP
    public function makeVip($id_cliente)
{
    $cliente = Cliente::findOrFail($id_cliente);

    // Validar si ya es VIP
    if ($cliente->vip) {
        return redirect()->route('clientes.index')->with('info', 'El cliente ya es VIP.');
    }

    // Asignar nivel y descuento automático
    $nivel = 'Bronce';
    $descuento = 5;

    ClienteVIP::create([
        'id_cliente' => $cliente->id_cliente,
        'nivel_vip' => $nivel,
        'porcentaje_descuento' => $descuento,
        'fecha_ingreso' => now(),
    ]);

    return redirect()->route('clientes.index')->with('success', 'Cliente ascendido a VIP correctamente.');
}


    // Relación para saber si un cliente es VIP
    public function vip()
    {
        return $this->hasOne(ClienteVIP::class, 'id_cliente');
    }
}
