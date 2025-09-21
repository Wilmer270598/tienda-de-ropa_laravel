<?php

// app/Http/Controllers/VentaController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Cliente;
use App\Models\ClienteVIP;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;
use App\Models\Inventario;


class VentaController extends Controller
{
    public function index()
{
    $ventas = Venta::with(['cliente', 'usuario', 'detalles.producto'])
                ->orderBy('id_venta', 'desc') // Ordena por último ID creado primero
                ->get();

    return view('ventas.index', compact('ventas'));
}

    public function create()
    {
        $clientes = Cliente::all();
        $productos = Producto::all();
        return view('ventas.create', compact('clientes', 'productos'));
    }

    public function store(Request $request)
{
    $request->validate([
        'id_cliente' => 'required|exists:cliente,id_cliente',
        'productos' => 'required|array',
        'productos.*.id_producto' => 'required|exists:producto,id_producto',
        'productos.*.cantidad' => 'required|integer|min:1',
    ]);

    DB::beginTransaction();

    try {
        $cliente = Cliente::with('vip')->findOrFail($request->id_cliente);
        $descuento = $cliente->vip ? $cliente->vip->porcentaje_descuento : 0;

        $venta = Venta::create([
            'id_cliente' => $request->id_cliente,
            'id_usuario' => $request->id_usuario,
            'fecha' => $request->fecha,
            'total' => 0,
        ]);

        $totalVenta = 0;
        $productosSinStock = [];

        foreach ($request->productos as $item) {
            $producto = Producto::findOrFail($item['id_producto']);
            $cantidad = (int) $item['cantidad'];

            if ($producto->stock_actual < $cantidad) {
                $productosSinStock[] = $producto->nombre;
                continue; // saltar este producto
            }

            $subtotal = $producto->precio * $cantidad;
            $subtotalConDescuento = $subtotal * (1 - $descuento / 100);

            // Guardar detalle
            $venta->detalles()->create([
                'id_producto' => $producto->id_producto,
                'cantidad' => $cantidad,
                'precio_unitario' => $producto->precio,
                'descuento_aplicado' => $descuento,
                'subtotal' => $subtotalConDescuento,
            ]);

            // Restar stock
            $producto->decrement('stock_actual', $cantidad);

            // Registrar en inventario
            Inventario::create([
                'id_producto' => $producto->id_producto,
                'tipo_movimiento' => 'salida',
                'cantidad' => $cantidad,
                'id_usuario' => Auth::id(),
                'observacion' => 'Venta',
                'fecha' => now(),
            ]);

            $totalVenta += $subtotalConDescuento;
        }

        // Actualizar total
        $venta->update(['total' => $totalVenta]);

        DB::commit();

        if (count($productosSinStock) > 0) {
            return redirect()->back()
                ->withInput()
                ->with('warning', 'Algunos productos no se incluyeron por falta de stock: ' . implode(', ', $productosSinStock));
        }

        return redirect()->route('ventas.index')->with('success', 'Venta registrada correctamente.');
    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->withInput()->with('error', 'Ocurrió un error: ' . $e->getMessage());
    }
}



}


