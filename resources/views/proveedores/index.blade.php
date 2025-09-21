@extends('layout')

@section('title', 'Proveedores')

@section('content')
<div class="card shadow-sm rounded-lg p-4">
    <h1 class="mb-4 text-center text-primary-dark">Catálogo de Proveedores</h1>
    <p class="text-secondary-light text-center mb-4">Gestiona a todos los proveedores de tu boutique.</p>

    <!-- Barra de búsqueda y botón de creación -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <form method="GET" action="{{ route('proveedores.index') }}" class="flex-grow-1 w-100">
            <div class="input-group rounded-pill overflow-hidden shadow-sm">
                <span class="input-group-text bg-white border-0 px-3"><i class="fas fa-search text-secondary"></i></span>
                <input type="text" name="search" class="form-control border-0 ps-0" placeholder="Buscar por nombre o NIT" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-4">Buscar</button>
            </div>
        </form>
        <a href="{{ route('proveedores.create') }}" class="btn btn-primary rounded-pill flex-shrink-0">
            <i class="fas fa-plus-circle me-2"></i> Agregar Proveedor
        </a>
    </div>

    <!-- Cuadrícula de proveedores -->
    <div class="proveedores-grid">
        @forelse($proveedores as $prov)
        <div class="proveedor-card shadow-sm rounded-lg">
            <h4 class="fw-bold mb-2 text-primary-dark">{{ $prov->nombre_proveedor }}</h4>
            <hr class="my-2">
            
            <p class="mb-1"><i class="fas fa-phone me-2 text-secondary-light"></i><span class="fw-bold">Teléfono:</span> {{ $prov->telefono }}</p>
            <p class="mb-1"><i class="fas fa-envelope me-2 text-secondary-light"></i><span class="fw-bold">Correo:</span> {{ $prov->correo }}</p>
            <p class="mb-1"><i class="fas fa-map-marker-alt me-2 text-secondary-light"></i><span class="fw-bold">Dirección:</span> {{ $prov->direccion }}</p>
            <p class="mb-1"><i class="fas fa-tshirt me-2 text-secondary-light"></i><span class="fw-bold">Rubro:</span> {{ $prov->rubro_tipoRopa }}</p>
            <p class="mb-1"><i class="fas fa-id-card-alt me-2 text-secondary-light"></i><span class="fw-bold">NIT:</span> {{ $prov->nit }}</p>
            <p class="mb-1"><i class="fas fa-toggle-on me-2 text-secondary-light"></i><span class="fw-bold">Estado:</span> {{ $prov->estado }}</p>
            <p class="mb-1"><i class="fas fa-star me-2 text-secondary-light"></i><span class="fw-bold">Tipo:</span> {{ $prov->tipoProveedor->nombre_tipoProveedor ?? 'N/A' }}</p>

            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('proveedores.edit', $prov->id_proveedor) }}" class="btn btn-secondary flex-fill rounded-pill">
                    <i class="fas fa-edit"></i> Editar
                </a>
                
                <button type="button" class="btn btn-danger flex-fill rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $prov->id_proveedor }}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </button>
            </div>
        </div>
        
        <!-- Modal de Confirmación de Eliminación -->
        <div class="modal fade" id="deleteModal{{ $prov->id_proveedor }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $prov->id_proveedor }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-lg">
                    <div class="modal-header bg-danger text-white rounded-top">
                        <h5 class="modal-title" id="deleteModalLabel{{ $prov->id_proveedor }}">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center text-dark py-4">
                        <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                        <p class="fw-bold h5">¿Estás seguro de que deseas eliminar a este proveedor?</p>
                        <p class="text-muted">Esta acción no se puede deshacer.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('proveedores.destroy', $prov->id_proveedor) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-pill">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-5">
            <i class="fas fa-truck fa-3x mb-3"></i>
            <p class="h5">¡No hay proveedores registrados!</p>
            <p class="text-muted">Aún no tienes proveedores en el sistema. Comienza a agregarlos.</p>
        </div>
        @endforelse
    </div>
</div>

<style>
    /* Estilos para el contenedor principal */
    .card {
        background-color: white;
        border: none;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }
    
    /* Paleta de colores consistente */
    .text-primary-dark { color: #2c3e50; }
    .text-secondary-light { color: #7f8c8d; }
    
    /* Botones con estilo mejorado */
    .btn-primary {
        background-color: #2c3e50;
        border-color: #2c3e50;
        font-weight: 500;
    }
    .btn-primary:hover {
        background-color: #34495e;
        border-color: #34495e;
    }
    .btn-danger {
        background-color: #e74c3c;
        border-color: #e74c3c;
    }
    .btn-danger:hover {
        background-color: #c0392b;
        border-color: #c0392b;
    }
    .btn-secondary {
        background-color: #95a5a6;
        border-color: #95a5a6;
    }
    .btn-secondary:hover {
        background-color: #7f8c8d;
        border-color: #7f8c8d;
    }

    /* Cuadrícula de proveedores (Grid) */
    .proveedores-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 24px;
    }
    
    /* Estilo de las tarjetas de proveedor */
    .proveedor-card {
        background-color: #f8f9fa;
        color: #34495e;
        padding: 24px;
        border: 1px solid #e9ecef;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }
    .proveedor-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    }

    /* Estilos del modal de confirmación */
    .modal-content {
        border-radius: 12px;
    }
    .modal-header {
        border-radius: 12px 12px 0 0;
    }
</style>
@endsection
