@extends('layout')

@section('title', 'Editar Proveedor')

@section('content')
<h2 class="mb-4" style="color:#fff;">Editar Proveedor</h2>

<form action="{{ route('proveedores.update', $proveedor->id_proveedor) }}" method="POST" style="background-color:#fff; padding:20px; border-radius:10px;">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label class="form-label">Nombre del proveedor</label>
        <input type="text" name="nombre_proveedor" class="form-control" value="{{ old('nombre_proveedor', $proveedor->nombre_proveedor) }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $proveedor->telefono) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Correo</label>
        <input type="email" name="correo" class="form-control" value="{{ old('correo', $proveedor->correo) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Dirección</label>
        <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $proveedor->direccion) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Rubro</label>
        <input type="text" name="rubro_tipoRopa" class="form-control" value="{{ old('rubro_tipoRopa', $proveedor->rubro_tipoRopa) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">NIT</label>
        <input type="text" name="nit" class="form-control" value="{{ old('nit', $proveedor->nit) }}">
    </div>

    <div class="mb-3">
        <label class="form-label">Estado</label>
        <select name="estado" class="form-select">
            <option value="activo" {{ old('estado', $proveedor->estado)=='activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ old('estado', $proveedor->estado)=='inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Tipo de Proveedor</label>
        <select name="id_tipoProveedor" class="form-select" required>
            <option value="">Selecciona un tipo</option>
            @foreach($tipos as $tipo)
                <option value="{{ $tipo->id_tipoProveedor }}" {{ old('id_tipoProveedor', $proveedor->id_tipoProveedor)==$tipo->id_tipoProveedor ? 'selected' : '' }}>
                    {{ $tipo->nombre_tipoProveedor }}
                </option>
            @endforeach
        </select>
    </div>

    <button type="submit" class="btn" style="background-color:#273e52; color:#fff;">Actualizar</button>
    <a href="{{ route('proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
