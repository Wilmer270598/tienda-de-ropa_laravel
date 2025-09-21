@extends('layout')

@section('title', 'Control de Inventario')

@section('content')
<div class="container">
    <h1 class="mb-4">Control de Inventario</h1>

    {{-- Botón para abrir modal --}}
    <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#agregarMercaderiaModal">
        <i class="fas fa-plus"></i> Agregar Mercadería
    </button>

    {{-- Productos con stock bajo --}}
    <div class="alert alert-warning">
        <h5>Productos con stock menor a 5 unidades:</h5>
        <ul>
            @foreach($productos_bajos as $prod)
                <li>{{ $prod->nombre }} - Stock: {{ $prod->stock_actual }}</li>
            @endforeach
            @if(count($productos_bajos) == 0)
                <li>Todos los productos tienen stock suficiente.</li>
            @endif
        </ul>
    </div>

    {{-- Tabla de inventario --}}
    <table class="table table-striped table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Producto</th>
                <th>Tipo Movimiento</th>
                <th>Cantidad</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Observación</th>
            </tr>
        </thead>
        <tbody>
            @foreach($inventarios as $inv)
            <tr>
                <td>{{ $inv->id_inventario }}</td>
                <td>{{ $inv->producto->nombre ?? 'Sin producto' }}</td>
                <td>{{ $inv->tipo_movimiento }}</td>
                <td>{{ $inv->cantidad }}</td>
                <td>{{ $inv->fecha }}</td>
                <td>{{ $inv->usuario->nombre_completo ?? 'Sin usuario' }}</td>
                <td>{{ $inv->observacion }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{-- Modal para agregar mercadería --}}
<div class="modal fade" id="agregarMercaderiaModal" tabindex="-1" aria-labelledby="agregarMercaderiaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('inventario.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="agregarMercaderiaModalLabel">Agregar Mercadería</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="producto_id" class="form-label">Producto</label>
                        <select name="producto_id" id="producto_id" class="form-select" required>
                            <option value="">Selecciona un producto</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id_producto }}">{{ $producto->nombre }} (Stock: {{ $producto->stock_actual }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" min="1" required>
                    </div>
                    <div class="mb-3">
                        <label for="tipo_movimiento" class="form-label">Tipo de Movimiento</label>
                        <select name="tipo_movimiento" id="tipo_movimiento" class="form-select" required>
                            <option value="entrada">Entrada</option>
                            <option value="salida">Salida</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="observacion" class="form-label">Observación</label>
                        <input type="text" name="observacion" id="observacion" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-success">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endsection
