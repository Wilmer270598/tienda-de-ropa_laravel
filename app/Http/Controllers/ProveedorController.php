<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use App\Models\TipoProveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        // 1. Obtiene el término de búsqueda de la URL
        $search = $request->query('search');

        // 2. Inicia la consulta del modelo Proveedor
        $query = Proveedor::with('tipoProveedor');

        // 3. Aplica el filtro si existe un término de búsqueda
        if ($search) {
            $query->where('nombre_proveedor', 'LIKE', "%{$search}%")
                  ->orWhere('nit', 'LIKE', "%{$search}%");
        }

        // 4. Ejecuta la consulta y obtiene los proveedores
        $proveedores = $query->get();

        // 5. Retorna la vista con los proveedores filtrados
        return view('proveedores.index', compact('proveedores'));
    }

    public function create()
    {
        $tipos = TipoProveedor::all();
        return view('proveedores.create', compact('tipos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_proveedor' => 'required|string',
            'telefono' => 'nullable|string',
            'correo' => 'nullable|email|unique:proveedor,correo',
            'direccion' => 'nullable|string',
            'rubro_tipoRopa' => 'nullable|string',
            'nit' => 'nullable|string|unique:proveedor,nit',
            'estado' => 'nullable|string',
            'id_tipoProveedor' => 'required|exists:tipo_proveedor,id_tipoProveedor',
        ]);

        Proveedor::create($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor creado.');
    }

    public function edit($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $tipos = TipoProveedor::all();
        return view('proveedores.edit', compact('proveedor', 'tipos'));
    }

    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $request->validate([
            'nombre_proveedor' => 'required|string',
            'telefono' => 'nullable|string',
            'correo' => "nullable|email|unique:proveedor,correo,$id,id_proveedor",
            'direccion' => 'nullable|string',
            'rubro_tipoRopa' => 'nullable|string',
            'nit' => "nullable|string|unique:proveedor,nit,$id,id_proveedor",
            'estado' => 'nullable|string',
            'id_tipoProveedor' => 'required|exists:tipo_proveedor,id_tipoProveedor',
        ]);
        $proveedor->update($request->all());
        return redirect()->route('proveedores.index')->with('success', 'Proveedor actualizado.');
    }

    public function destroy($id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->delete();
        return redirect()->route('proveedores.index')->with('success', 'Proveedor eliminado.');
    }
}