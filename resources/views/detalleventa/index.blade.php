@extends('layout')

@section('title', 'Detalle de Ventas')

@section('content')
<div class="card shadow-sm rounded-lg p-4">
    <h1 class="mb-4 text-center text-primary-dark">Detalle de Ventas</h1>
    <p class="text-secondary-light text-center mb-4">Revisa el historial de ventas y sus detalles para generar facturas.</p>

    <div class="table-responsive">
        <table class="table table-hover table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID Venta</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Usuario</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Total</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($ventas as $venta)
                <tr>
                    <td class="fw-bold">{{ $venta->id_venta }}</td>
                    <td>
                        {{ $venta->cliente ? 
                            $venta->cliente->nombre_cliente . ' ' . $venta->cliente->apellido_paterno . ' ' . $venta->cliente->apellido_materno 
                            : 'N/A' }}
                    </td>
                    <td>{{ $venta->usuario->nombre ?? 'N/A' }}</td>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha)->isoFormat('D MMMM YYYY') }}</td>
                    <td>Bs. {{ number_format($venta->total, 2) }}</td>
                    <td>
                        <a href="{{ route('detalleventa.show', $venta->id_venta) }}" class="btn btn-primary rounded-pill btn-sm">
                            <i class="fas fa-file-invoice me-1"></i> Ver/Imprimir
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-5">
                        <i class="fas fa-box-open fa-2x mb-3"></i>
                        <p class="h5">No hay detalles de ventas registrados.</p>
                        <p class="text-muted">¡Aún no se han generado ventas para mostrar aquí!</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

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
</style>
@endsection
