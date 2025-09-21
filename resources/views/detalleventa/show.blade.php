@extends('layout')

@section('title', 'Detalle de Venta')

@section('content')
<div class="card shadow-sm rounded-lg p-4 invoice-container">
    <div class="invoice-header mb-4 d-flex justify-content-between align-items-center">
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo Boutique" style="height: 60px;">
        </div>
        <div>
            <h1 class="mb-0 text-primary-dark">Factura de Venta</h1>
            <h2 class="h5 text-secondary-light">Venta #{{ $venta->id_venta }}</h2>
        </div>
    </div>
    <hr class="invoice-divider mb-4">

    <div class="invoice-details mb-4">
        <div class="row">
            <div class="col-md-6">
                <p class="mb-1"><strong>Cliente:</strong> {{ $venta->cliente->nombre_cliente ?? 'N/A' }} {{ $venta->cliente->apellido_paterno ?? '' }} {{ $venta->cliente->apellido_materno ?? '' }}</p>
                <p class="mb-1"><strong>Usuario:</strong> {{ $venta->usuario->nombre ?? 'N/A' }}</p>
            </div>
            <div class="col-md-6 text-end">
                <p class="mb-1"><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($venta->fecha)->isoFormat('D MMMM YYYY') }}</p>
                <p class="mb-1"><strong>Hora:</strong> {{ \Carbon\Carbon::parse($venta->fecha)->isoFormat('h:mm a') }}</p>
            </div>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID Producto</th>
                    <th scope="col">Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Precio Unitario</th>
                    <th scope="col">Descuento</th>
                    <th scope="col">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($venta->detalles as $detalle)
                <tr>
                    <td>{{ $detalle->id_producto }}</td>
                    <td>{{ $detalle->producto->nombre ?? 'N/A' }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>Bs. {{ number_format($detalle->precio_unitario, 2) }}</td>
                    <td>{{ number_format($detalle->descuento_aplicado, 2) }}%</td>
                    <td>Bs. {{ number_format($detalle->subtotal, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="table-light">
                    <th colspan="5" class="text-end fw-bold">Total</th>
                    <th class="fw-bold">Bs. {{ number_format($venta->total, 2) }}</th>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="d-flex justify-content-end mt-4 no-print">
        <button class="btn btn-primary me-2" onclick="window.print()">
            <i class="fas fa-print me-1"></i> Imprimir Factura
        </button>
        <a href="{{ route('detalleventa.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-1"></i> Volver
        </a>
    </div>
</div>

<style>
    /* Estilos generales */
    .card {
        background-color: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    .text-primary-dark {
        color: #2c3e50;
    }
    .text-secondary-light {
        color: #7f8c8d;
    }
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

    /* Estilos para la tabla */
    .table-dark {
        background-color: #2c3e50 !important;
        color: #ecf0f1;
        border-bottom: 2px solid #34495e;
    }
    .table-bordered th, .table-bordered td {
        border-color: #e9ecef;
    }
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f4f6f8;
    }
    tfoot th {
        background-color: #e9ecef;
    }

    /* Estilos de impresión */
    @media print {
        body * {
            visibility: hidden;
        }
        .invoice-container, .invoice-container * {
            visibility: visible;
        }
        .invoice-container {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            box-shadow: none !important;
            border-radius: 0 !important;
            padding: 20px !important;
        }
        .no-print {
            display: none !important;
        }
        .invoice-header, .invoice-details, .table-responsive, .invoice-divider {
            margin: 0 !important;
        }
        .logo {
            text-align: left !important;
        }
        .invoice-header h1 {
            font-size: 1.5rem;
        }
        .invoice-header h2 {
            font-size: 1rem;
        }
        .invoice-details p {
            font-size: 0.9rem;
        }
        table {
            font-size: 0.9rem;
        }
    }
</style>
@endsection
