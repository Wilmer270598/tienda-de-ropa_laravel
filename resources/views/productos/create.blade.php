@extends('layout')

@section('title', 'Crear Producto')

@section('content')
<div class="container mx-auto p-4">
    <div style="background-color: #5583ab; padding: 30px; border-radius: 10px; color: #fff; max-width: 600px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
        <h2 class="mb-4 text-center" style="font-weight: bold; font-size: 1.8rem;">Crear Producto</h2>

        <form action="{{ route('productos.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Talla</label>
                <input type="text" name="talla" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Color</label>
                <input type="text" name="color" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input type="number" step="0.01" name="precio" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Stock Actual</label>
                <input type="number" name="stock_actual" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select name="id_categoria" class="form-select">
                    <option value="">-- Seleccionar --</option>
                    @foreach($categorias as $c)
                        <option value="{{ $c->id_categoria }}">{{ $c->nombre_categoria }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Temporada</label>
                <select name="id_temporada" class="form-select">
                    <option value="">-- Seleccionar --</option>
                    @foreach($temporadas as $t)
                        <option value="{{ $t->id_temporada }}">{{ $t->nombre_temporada }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Proveedor</label>
                <select name="id_proveedor" class="form-select">
                    <option value="">-- Seleccionar --</option>
                    @foreach($proveedores as $p)
                        <option value="{{ $p->id_proveedor }}">{{ $p->nombre_proveedor }}</option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn" style="background-color: #273e52; color: #fff; width: 48%;">Guardar</button>
                <a href="{{ route('productos.index') }}" class="btn" style="background-color: #3b5a78; color: #fff; width: 48%;">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<style>
    input.form-control, select.form-select, textarea.form-control {
        background-color: #d1e0f0;
        color: #000;
        border: 1px solid #273e52;
        border-radius: 5px;
        padding: 8px;
    }

    input.form-control:focus, select.form-select:focus, textarea.form-control:focus {
        background-color: #e4f0fb;
        border-color: #18466b;
        box-shadow: none;
    }

    label.form-label {
        font-weight: 600;
    }
</style>
@endsection