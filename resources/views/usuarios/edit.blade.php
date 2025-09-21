@extends('layout')

@section('title', 'Editar Usuario')

@section('content')
<h2 class="mb-4">Editar Usuario</h2>

<form action="{{ route('usuarios.update', $usuario->id_usuario) }}" method="POST" style="background-color: #5583ab; padding: 20px; border-radius: 8px; color: #fff;">
    @csrf
    @method('PUT')
    
    <div class="mb-3">
        <label>Nombre de Usuario</label>
        <input type="text" name="nombre" class="form-control" value="{{ $usuario->nombre }}" required>
    </div>

    <div class="mb-3">
        <label>Contraseña (dejar vacío si no quieres cambiarla)</label>
        <input type="password" name="contraseña" class="form-control">
    </div>

    <div class="mb-3">
        <label>Nombre Completo</label>
        <input type="text" name="nombre_completo" class="form-control" value="{{ $usuario->nombre_completo }}" required>
    </div>

    <div class="mb-3">
        <label>Rol (1 = Administrador, 2 = Trabajador)</label>
        <input type="number" name="id_rol" class="form-control" value="{{ $usuario->id_rol }}" required>
    </div>

    <button type="submit" class="btn" style="background-color: #273e52; color: #fff;">Actualizar</button>
    <a href="{{ route('usuarios.index') }}" class="btn btn-secondary" style="background-color: #3b5a78; color: #fff;">Cancelar</a>
</form>

<style>
    input.form-control {
        background-color: #d1e0f0;
        color: #000;
        border: 1px solid #273e52;
    }

    input.form-control:focus {
        background-color: #e4f0fb;
        border-color: #18466b;
        box-shadow: none;
    }
</style>
@endsection
