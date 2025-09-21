@extends('layout')

@section('title', 'Clientes VIP')

@section('content')
<h2 class="mb-4" style="color:#fff;">Clientes VIP</h2>

<!-- Botones para navegar entre tipos de clientes -->
<div style="margin-bottom: 20px;">
    <a href="{{ route('clientes_comunes.index') }}" class="btn" style="background-color:#273e52; color:#fff;">Cliente Común</a>
    <a href="{{ route('clientes_vip.index') }}" class="btn" style="background-color:#f1c40f; color:#000;">Cliente VIP</a>
</div>

<!-- Buscador -->
<form method="GET" action="{{ route('clientes_vip.index') }}" style="margin-bottom:20px;">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por Nombre o Apellidos" value="{{ request('search') }}">
        <button type="submit" class="btn" style="background-color:#273e52; color:#fff;">Buscar</button>
    </div>
</form>

<!-- Grid de clientes VIP -->
<div class="clientes-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
    @foreach($clientes as $clienteVIP)
    <div class="cliente-card" style="background-color: #5583ab; color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: transform 0.3s;">
        <h4>{{ ucwords(strtolower($clienteVIP->cliente->nombre_cliente)) }} {{ ucwords(strtolower($clienteVIP->cliente->apellido_paterno)) }} {{ ucwords(strtolower($clienteVIP->cliente->apellido_materno)) }}</h4>

        <p><strong>Teléfono:</strong> {{ $clienteVIP->cliente->telefono }}</p>
        <p><strong>Email:</strong> {{ $clienteVIP->cliente->email }}</p>
        <p><strong>Dirección:</strong> {{ $clienteVIP->cliente->direccion }}</p>
        <p><strong>Nivel VIP:</strong> {{ $clienteVIP->nivel_vip }}</p>
        <p><strong>Descuento:</strong> {{ $clienteVIP->porcentaje_descuento }}%</p>

        @if(auth()->user()->id_rol == 1)
        <div style="margin-top: 15px; display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('clientes_vip.edit', $clienteVIP->id_cliente) }}" class="btn" style="background-color:#273e52; color:#fff; flex:1;">Editar</a>

            <form id="delete-form-{{ $clienteVIP->id_cliente }}" action="{{ route('clientes_vip.destroy', $clienteVIP->id_cliente) }}" method="POST" style="flex:1;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn" style="background-color:#ab5555; color:#fff; width:100%;" onclick="confirmDelete({{ $clienteVIP->id_cliente }})">Eliminar</button>
            </form>
        </div>
        @endif
    </div>
    @endforeach
</div>

@if(auth()->user()->id_rol == 1)
<script>
let userIdToDelete = null;

function confirmDelete(userId) {
    userIdToDelete = userId;
    if(confirm('¿Estás seguro de eliminar este cliente VIP?')) {
        document.getElementById('delete-form-' + userId).submit();
    }
}
</script>
@endif
@endsection
