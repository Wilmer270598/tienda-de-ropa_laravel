<?php

namespace App\Http\Controllers;

use App\Models\TipoProveedor;
use Illuminate\Http\Request;

class TipoProveedorController extends Controller
{
    public function index()
    {
        $tipos = TipoProveedor::all();
        return view('tipos_proveedor.index', compact('tipos'));
    }

    public function create()
    {
        return view('tipos_proveedor.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_tipoProveedor' => 'required|string|unique:tipo_proveedor,nombre_tipoProveedor',
        ]);

        TipoProveedor::create($request->all());
        return redirect()->route('tipos_proveedor.index')->with('success', 'Tipo de proveedor creado.');
    }

    public function edit($id)
    {
        $tipo = TipoProveedor::findOrFail($id);
        return view('tipos_proveedor.edit', compact('tipo'));
    }

    public function update(Request $request, $id)
    {
        $tipo = TipoProveedor::findOrFail($id);
        $request->validate([
            'nombre_tipoProveedor' => "required|string|unique:tipo_proveedor,nombre_tipoProveedor,$id,id_tipoProveedor",
        ]);
        $tipo->update($request->all());
        return redirect()->route('tipos_proveedor.index')->with('success', 'Tipo de proveedor actualizado.');
    }

    public function destroy($id)
    {
        $tipo = TipoProveedor::findOrFail($id);
        $tipo->delete();
        return redirect()->route('tipos_proveedor.index')->with('success', 'Tipo de proveedor eliminado.');
    }
}
