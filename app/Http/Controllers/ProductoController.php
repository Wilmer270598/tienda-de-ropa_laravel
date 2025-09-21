<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Temporada;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    // Mostrar lista de productos con búsqueda
    public function index(Request $request) {
        $search = $request->query('search');

        $query = Producto::with('categoria', 'temporada', 'proveedor');

        if ($search) {
            $query->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhereHas('proveedor', function ($q) use ($search) {
                      $q->where('nombre_proveedor', 'LIKE', "%{$search}%");
                  });
        }

        $productos = $query->get();
        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario para crear producto
    public function create()
    {
        $categorias = Categoria::all();
        $temporadas = Temporada::all();
        $proveedores = Proveedor::all();

        return view('productos.create', compact('categorias', 'temporadas', 'proveedores'));
    }

    // Guardar producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'talla' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'id_categoria' => 'nullable|exists:categoria,id_categoria',
            'id_temporada' => 'nullable|exists:temporada,id_temporada',
            'id_proveedor' => 'nullable|exists:proveedor,id_proveedor',
        ]);

        Producto::create($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    // Mostrar formulario para editar producto
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        $temporadas = Temporada::all();
        $proveedores = Proveedor::all();

        return view('productos.edit', compact('producto', 'categorias', 'temporadas', 'proveedores'));
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'talla' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:50',
            'precio' => 'required|numeric|min:0',
            'stock_actual' => 'required|integer|min:0',
            'id_categoria' => 'nullable|exists:categoria,id_categoria',
            'id_temporada' => 'nullable|exists:temporada,id_temporada',
            'id_proveedor' => 'nullable|exists:proveedor,id_proveedor',
        ]);

        $producto->update($request->all());

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}