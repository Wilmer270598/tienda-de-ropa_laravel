@extends('layout')

@section('title', 'Agregar Proveedor')

@section('content')
<div class="container mx-auto p-4">
    <div style="background-color: #5583ab; padding: 30px; border-radius: 10px; color: #fff; max-width: 600px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
        <h2 class="mb-4 text-center" style="font-weight: bold; font-size: 1.8rem;">Agregar Proveedor</h2>

        <form action="{{ route('proveedores.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre del proveedor</label>
                <input type="text" name="nombre_proveedor" class="form-control" value="{{ old('nombre_proveedor') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ old('telefono') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control" value="{{ old('correo') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{ old('direccion') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Rubro</label>
                <input type="text" name="rubro_tipoRopa" class="form-control" value="{{ old('rubro_tipoRopa') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">NIT</label>
                <input type="text" name="nit" class="form-control" value="{{ old('nit') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Estado</label>
                <select name="estado" class="form-select" style="background-color: #d1e0f0; color: #000; border: 1px solid #273e52;">
                    <option value="activo" {{ old('estado') == 'activo' ? 'selected' : '' }}>Activo</option>
                    <option value="inactivo" {{ old('estado') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de Proveedor</label>
                <select name="id_tipoProveedor" class="form-select" required style="background-color: #d1e0f0; color: #000; border: 1px solid #273e52;">
                    <option value="">Selecciona un tipo</option>
                    @foreach($tipos as $tipo)
                        <option value="{{ $tipo->id_tipoProveedor }}" {{ old('id_tipoProveedor') == $tipo->id_tipoProveedor ? 'selected' : '' }}>
                            {{ $tipo->nombre_tipoProveedor }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn" style="background-color: #273e52; color: #fff; width: 48%;">Guardar</button>
                <a href="{{ route('proveedores.index') }}" class="btn" style="background-color: #3b5a78; color: #fff; width: 48%;">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<style>
    input.form-control, select.form-select {
        background-color: #d1e0f0;
        color: #000;
        border: 1px solid #273e52;
        border-radius: 5px;
        padding: 8px;
    }

    input.form-control:focus, select.form-select:focus {
        background-color: #e4f0fb;
        border-color: #18466b;
        box-shadow: none;
    }

    label.form-label {
        font-weight: 600;
    }
</style>
@endsection