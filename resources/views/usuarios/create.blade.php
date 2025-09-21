@extends('layout')

@section('title', 'Agregar Usuario')

@section('content')
<div class="container mx-auto p-4">
    <div style="background-color: #5583ab; padding: 30px; border-radius: 10px; color: #fff; max-width: 600px; margin: auto; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
        <h2 class="mb-4 text-center" style="font-weight: bold; font-size: 1.8rem;">Agregar Usuario</h2>

        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Nombre de Usuario</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input type="password" name="contraseña" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre Completo</label>
                <input type="text" name="nombre_completo" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Rol (1 = Administrador, 2 = Trabajador)</label>
                <input type="number" name="id_rol" class="form-control" required>
            </div>

            <div class="d-flex justify-content-between mt-4">
                <button type="submit" class="btn" style="background-color: #273e52; color: #fff; width: 48%;">Guardar</button>
                <a href="{{ route('usuarios.index') }}" class="btn" style="background-color: #3b5a78; color: #fff; width: 48%;">Cancelar</a>
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
