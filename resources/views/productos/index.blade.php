@extends('layout')

@section('title', 'Productos')

@section('content')
<div class="card shadow-sm rounded-lg p-4">
    <h1 class="mb-4 text-center text-primary-dark">Catálogo de Productos</h1>
    <p class="text-secondary-light text-center mb-4">Gestiona el inventario de prendas de tu boutique.</p>

    <!-- Barra de búsqueda y botón de creación -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <form method="GET" action="{{ route('productos.index') }}" class="flex-grow-1 w-100">
            <div class="input-group rounded-pill overflow-hidden shadow-sm">
                <span class="input-group-text bg-white border-0 px-3"><i class="fas fa-search text-secondary"></i></span>
                <input type="text" name="search" class="form-control border-0 ps-0" placeholder="Buscar por nombre o proveedor" value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary px-4">Buscar</button>
            </div>
        </form>

        @if(auth()->user()->id_rol == 1)
            <!-- Solo administrador puede crear productos -->
            <a href="{{ route('productos.create') }}" class="btn btn-primary rounded-pill flex-shrink-0">
                <i class="fas fa-plus-circle me-2"></i> Crear Producto
            </a>
        @endif
    </div>

    <!-- Cuadrícula de productos -->
    <div class="productos-grid">
        @forelse($productos as $p)
        <div class="producto-card shadow-sm rounded-lg">
            <h4 class="fw-bold mb-2 text-primary-dark">{{ $p->nombre }}</h4>
            <hr class="my-2">
            
            <p class="mb-1"><i class="fas fa-file-alt me-2 text-secondary-light"></i><span class="fw-bold">Descripción:</span> {{ $p->descripcion }}</p>
            <p class="mb-1"><i class="fas fa-dollar-sign me-2 text-secondary-light"></i><span class="fw-bold">Precio:</span> Bs. {{ number_format($p->precio, 2) }}</p>
            <p class="mb-1"><i class="fas fa-ruler-horizontal me-2 text-secondary-light"></i><span class="fw-bold">Talla:</span> {{ $p->talla }}</p>
            <p class="mb-1"><i class="fas fa-palette me-2 text-secondary-light"></i><span class="fw-bold">Color:</span> {{ $p->color }}</p>
            <p class="mb-1"><i class="fas fa-cubes me-2 text-secondary-light"></i><span class="fw-bold">Stock:</span> {{ $p->stock_actual }}</p>
            <p class="mb-1"><i class="fas fa-tag me-2 text-secondary-light"></i><span class="fw-bold">Categoría:</span> {{ $p->categoria?->nombre_categoria }}</p>
            <p class="mb-1"><i class="fas fa-sun me-2 text-secondary-light"></i><span class="fw-bold">Temporada:</span> {{ $p->temporada?->nombre_temporada }}</p>
            <p class="mb-1"><i class="fas fa-truck me-2 text-secondary-light"></i><span class="fw-bold">Proveedor:</span> {{ $p->proveedor?->nombre_proveedor }}</p>

            @if(auth()->user()->id_rol == 1)
            <!-- Solo administrador ve los botones -->
            <div class="d-flex gap-2 mt-3">
                <a href="{{ route('productos.edit', $p->id_producto) }}" class="btn btn-secondary flex-fill rounded-pill">
                    <i class="fas fa-edit"></i> Editar
                </a>
                
                <button type="button" class="btn btn-danger flex-fill rounded-pill" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $p->id_producto }}">
                    <i class="fas fa-trash-alt"></i> Eliminar
                </button>
            </div>
            @endif
        </div>
        
        @if(auth()->user()->id_rol == 1)
        <!-- Modal de Confirmación de Eliminación (solo para admins) -->
        <div class="modal fade" id="deleteModal{{ $p->id_producto }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $p->id_producto }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content rounded-lg">
                    <div class="modal-header bg-danger text-white rounded-top">
                        <h5 class="modal-title" id="deleteModalLabel{{ $p->id_producto }}">Confirmar Eliminación</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center text-dark py-4">
                        <i class="fas fa-exclamation-triangle fa-3x text-danger mb-3"></i>
                        <p class="fw-bold h5">¿Estás seguro de que deseas eliminar este producto?</p>
                        <p class="text-muted">Esta acción no se puede deshacer.</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('productos.destroy', $p->id_producto) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-pill">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @empty
        <div class="col-12 text-center text-muted py-5">
            <i class="fas fa-tshirt fa-3x mb-3"></i>
            <p class="h5">¡Tu catálogo está vacío!</p>
            <p class="text-muted">No hay productos registrados aún. Comienza a agregar el inventario de tu boutique.</p>
        </div>
        @endforelse
    </div>
</div>
@endsection
