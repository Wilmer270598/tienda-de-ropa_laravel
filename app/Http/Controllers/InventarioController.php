<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class InventarioController extends Controller
{
    public function index()
    {
        // Todos los movimientos de inventario con relaciones
        $inventarios = Inventario::with(['producto', 'usuario'])->orderBy('fecha', 'desc')->get();

        // Todos los productos para el select del modal
        $productos = Producto::all();

        // Productos con stock menor a 5
        $productos_bajos = Producto::where('stock_actual', '<', 5)->get();

        return view('inventario.index', compact('inventarios', 'productos', 'productos_bajos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:producto,id_producto',
            'cantidad' => 'required|integer|min:1',
            'tipo_movimiento' => 'required|in:entrada,salida',
        ]);

        $producto = Producto::find($request->producto_id);

        if (!$producto) {
            return redirect()->back()->with('error', 'Producto no encontrado.');
        }

        // Ajustar stock según tipo de movimiento
        if($request->tipo_movimiento == 'entrada'){
            $producto->stock_actual += $request->cantidad;
        } else {
            $producto->stock_actual -= $request->cantidad;
        }
        $producto->save();

        // Registrar movimiento en inventario
        Inventario::create([
            'id_producto' => $producto->id_producto,
            'tipo_movimiento' => $request->tipo_movimiento,
            'cantidad' => $request->cantidad,
            'id_usuario' => Auth::id(),
            'observacion' => $request->observacion,
            'fecha' => now(),
        ]);

        return redirect()->route('inventario.index')->with('success', 'Movimiento registrado correctamente.');
    }
}
