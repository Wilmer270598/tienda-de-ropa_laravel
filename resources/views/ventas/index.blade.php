@extends('layout')

@section('title', 'Historial de Ventas')

@section('content')
<div class="card shadow-sm rounded-lg p-4">
    <h1 class="mb-4 text-center text-primary-dark">Historial de Ventas</h1>
    <p class="text-secondary-light text-center mb-4">Revisa todas las ventas realizadas, sus detalles y el total.</p>

    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('ventas.create') }}" class="btn btn-primary rounded-pill">
            <i class="fas fa-plus-circle me-2"></i> Nueva Venta
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Total</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ventas as $venta)
                <tr>
                    <td class="fw-bold">{{ $venta->id_venta }}</td>
                    <td>{{ $venta->cliente ? $venta->cliente->nombre_cliente.' '.$venta->cliente->apellido_paterno.' '.$venta->cliente->apellido_materno : 'N/A' }}</td>
                    <td>{{ $venta->usuario ? $venta->usuario->nombre : 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha)->isoFormat('D MMMM YYYY') }}</td>
                    <td>Bs. {{ number_format($venta->total, 2) }}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detalleModal{{ $venta->id_venta }}">
                            <i class="fas fa-eye me-1"></i> Ver
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="fas fa-box-open fa-2x mb-3"></i>
                        <p class="h5">No hay ventas registradas aún.</p>
                        <p class="text-muted">¡Comienza a registrar tu primera venta para verla aquí!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Modales para cada venta (uno por fila) -->
@foreach($ventas as $venta)
<div class="modal fade" id="detalleModal{{ $venta->id_venta }}" tabindex="-1" aria-labelledby="detalleModalLabel{{ $venta->id_venta }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content rounded-lg">
            <div class="modal-header bg-primary-dark text-white rounded-top">
                <h5 class="modal-title" id="detalleModalLabel{{ $venta->id_venta }}">Detalle de la Venta #{{ $venta->id_venta }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <p><strong>Cliente:</strong> {{ $venta->cliente ? $venta->cliente->nombre_cliente.' '.$venta->cliente->apellido_paterno.' '.$venta->cliente->apellido_materno : 'N/A' }}</p>
                <p><strong>Usuario:</strong> {{ $venta->usuario ? $venta->usuario->nombre : 'N/A' }}</p>
                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fecha)->isoFormat('D MMMM YYYY, h:mm a') }}</p>
                <hr>
                <h6>Productos vendidos:</h6>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm mt-3">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Descuento</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($venta->detalles as $detalle)
                            <tr>
                                <td>{{ $detalle->producto->nombre ?? 'N/A' }}</td>
                                <td>{{ $detalle->cantidad }}</td>
                                <td>Bs. {{ number_format($detalle->precio_unitario, 2) }}</td>
                                <td>{{ number_format($detalle->descuento_aplicado, 2) }}%</td>
                                <td>Bs. {{ number_format($detalle->subtotal, 2) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h5 class="mt-4 text-end">Total de la Venta: <span class="fw-bold">Bs. {{ number_format($venta->total, 2) }}</span></h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<style>
    /* Clases para el contenedor principal de la tabla */
    .card {
        background-color: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    /* Botones con estilo más moderno */
    .btn-primary {
        background-color: #2c3e50;
        border-color: #2c3e50;
        font-weight: 500;
        transition: background-color 0.3s ease;
    }
    .btn-primary:hover {
        background-color: #34495e;
        border-color: #34495e;
    }

    /* Tabla con estilo mejorado */
    .table-dark {
        background-color: #2c3e50 !important;
        color: #ecf0f1;
        border-bottom: 2px solid #34495e;
    }
    .table-hover tbody tr:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }
    .table-bordered th, .table-bordered td {
        border-color: #e9ecef;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f4f6f8;
    }
    
    /* Colores personalizados */
    .text-primary-dark {
        color: #2c3e50;
    }
    .text-secondary-light {
        color: #7f8c8d;
    }
    
    /* Estilos para el modal */
    .modal-header {
        border-bottom: none;
    }
    .modal-footer {
        border-top: none;
    }
</style>
@endsection
