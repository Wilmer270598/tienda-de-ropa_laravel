@extends('layout')

@section('title', 'Editar Cliente Común')

@section('content')
<h2 class="mb-4" style="color:#fff;">Editar Cliente Común</h2>

<div style="margin-bottom: 20px; display: flex; gap: 10px;">
    <a href="{{ route('clientes_comunes.index') }}" class="btn" style="background-color:#3498db; color:#fff; flex:1;">Clientes Común</a>
    <a href="{{ route('clientes_vip.index') }}" class="btn" style="background-color:#f1c40f; color:#000; flex:1;">Clientes VIP</a>
</div>

<form action="{{ route('clientes_comunes.update', $clienteComun->id_cliente) }}" method="POST" style="background-color:#5583ab; padding:20px; border-radius:10px; color:#fff; max-width:600px;">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Nombre:</label>
        <input type="text" name="nombre_cliente" class="form-control" value="{{ old('nombre_cliente', $clienteComun->cliente->nombre_cliente) }}">
        @error('nombre_cliente') <span style="color:#f1c40f;">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Apellido Paterno:</label>
        <input type="text" name="apellido_paterno" class="form-control" value="{{ old('apellido_paterno', $clienteComun->cliente->apellido_paterno) }}">
        @error('apellido_paterno') <span style="color:#f1c40f;">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Apellido Materno:</label>
        <input type="text" name="apellido_materno" class="form-control" value="{{ old('apellido_materno', $clienteComun->cliente->apellido_materno) }}">
        @error('apellido_materno') <span style="color:#f1c40f;">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Teléfono:</label>
        <input type="text" name="telefono" class="form-control" value="{{ old('telefono', $clienteComun->cliente->telefono) }}">
    </div>

    <div class="mb-3">
        <label>Email:</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $clienteComun->cliente->email) }}">
        @error('email') <span style="color:#f1c40f;">{{ $message }}</span> @enderror
    </div>

    <div class="mb-3">
        <label>Dirección:</label>
        <input type="text" name="direccion" class="form-control" value="{{ old('direccion', $clienteComun->cliente->direccion) }}">
    </div>

    <button type="submit" class="btn" style="background-color:#273e52; color:#fff;">Actualizar Cliente Común</button>
</form>
@endsection
