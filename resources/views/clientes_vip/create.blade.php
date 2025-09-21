@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ascender a VIP</h2>
    <form action="{{ route('clientes_vip.store') }}" method="POST">
        @csrf
        <input type="hidden" name="id_cliente" value="{{ $cliente->id_cliente }}">

        <div class="mb-3">
            <label>Nombre del Cliente:</label>
            <input type="text" class="form-control" value="{{ $cliente->nombre }}" disabled>
        </div>

        <div class="mb-3">
            <label for="nivel_vip">Nivel VIP:</label>
            <input type="text" name="nivel_vip" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="porcentaje_descuento">% Descuento:</label>
            <input type="number" name="porcentaje_descuento" step="0.01" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fecha_ingreso">Fecha de ascenso:</label>
            <input type="date" name="fecha_ingreso" value="{{ now()->toDateString() }}" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
    </form>
</div>
@endsection
