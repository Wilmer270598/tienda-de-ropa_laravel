<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\DetalleVenta;
use Illuminate\Support\Facades\Auth;

class DetalleVentaController extends Controller
{
    public function index()
{
    $ventas = Venta::with(['cliente', 'usuario', 'detalles.producto'])
                    ->orderBy('id_venta', 'desc') // Última venta primero
                    ->get();

    return view('detalleventa.index', compact('ventas'));
}

    public function store(Request $request)
{
    $request->validate([
        'id_cliente' => 'required|exists:cliente,id_cliente',
        'productos' => 'required|array',
        'productos.*.id_producto' => 'required|exists:producto,id_producto',
        'productos.*.cantidad' => 'required|integer|min:1',
    ]);

    // Crear la venta con total temporal 0
    $venta = Venta::create([
        'id_cliente' => $request->id_cliente,
        'id_usuario' => Auth::id(),
        'fecha' => now(),
        'total' => 0,
    ]);

    $totalVenta = 0;

    foreach ($request->productos as $item) {
        $producto = Producto::find($item['id_producto']);
        if (!$producto) {
            return redirect()->back()->with('error', "Producto no encontrado.");
        }

        $cantidad = (int) $item['cantidad'];

        // Verificar stock suficiente
        if ($producto->stock_actual < $cantidad) {
            return redirect()->back()->with('error', "No hay suficiente stock para {$producto->nombre}. Stock actual: {$producto->stock_actual}");
        }

        // Reducir stock del producto
        $producto->stock_actual -= $cantidad;
        $producto->save();

        // Registrar movimiento en inventario
        Inventario::create([
            'id_producto' => $producto->id_producto,
            'tipo_movimiento' => 'salida',
            'cantidad' => $cantidad,
            'id_usuario' => Auth::id(),
            'observacion' => 'Venta',
            'fecha' => now(),
        ]);

        // Calcular subtotal
        $subtotal = $producto->precio * $cantidad;

        // Guardar detalle de venta
        DetalleVenta::create([
    'id_venta' => $venta->id_venta,
    'id_producto' => $producto->id_producto,
    'cantidad' => $cantidad,
    'precio_unitario' => $producto->precio,  // obligatorio
    'subtotal' => $producto->precio * $cantidad, // obligatorio
    'descuento_aplicado' => 0
]);


        // Sumar al total de la venta
        $totalVenta += $subtotal;
    }

    // Actualizar total de la venta
    $venta->total = $totalVenta;
    $venta->save();

    return redirect()->route('detalleventa.index')->with('success', 'Venta registrada correctamente y stock actualizado.');
}


    public function show($id)
    {
        $venta = Venta::with(['cliente', 'usuario', 'detalles.producto'])->findOrFail($id);
        return view('detalleventa.show', compact('venta'));
    }
}
