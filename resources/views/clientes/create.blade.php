@extends('layout')

@section('title', 'Agregar Cliente')

@section('content')
<div class="container mx-auto p-4">
    <div style="background-color: #5583ab; padding: 30px; border-radius: 10px; color: #fff; max-width: 600px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
        <h2 class="mb-4 text-center" style="font-weight: bold; font-size: 1.8rem;">Agregar Cliente</h2>

        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre_cliente" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido Paterno</label>
                <input type="text" name="apellido_paterno" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellido Materno</label>
                <input type="text" name="apellido_materno" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control">
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn" style="background-color: #273e52; color: #fff; width: 48%;">Guardar</button>
                <a href="{{ route('clientes.index') }}" class="btn" style="background-color: #3b5a78; color: #fff; width: 48%;">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<style>
    input.form-control {
        background-color: #d1e0f0;
        color: #000;
        border: 1px solid #273e52;
        border-radius: 5px;
        padding: 8px;
    }

    input.form-control:focus {
        background-color: #e4f0fb;
        border-color: #18466b;
        box-shadow: none;
    }

    label.form-label {
        font-weight: 600;
    }
</style>
@endsection
