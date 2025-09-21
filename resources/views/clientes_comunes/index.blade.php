@extends('layout')

@section('title', 'Clientes Comunes')

@section('content')
<h2 class="mb-4" style="color:#fff;">Clientes Comunes</h2>

<!-- Botones de navegación superior -->
<div style="margin-bottom: 20px;">
    <a href="{{ route('clientes_comunes.index') }}" class="btn" style="background-color:#273e52; color:#fff;">Cliente Común</a>
    <a href="{{ route('clientes_vip.index') }}" class="btn" style="background-color:#f1c40f; color:#000;">Cliente VIP</a>
</div>

<!-- Buscador -->
<form method="GET" action="{{ route('clientes_comunes.index') }}" style="margin-bottom:20px;">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Buscar por Nombre o Apellidos" value="{{ request('search') }}">
        <button type="submit" class="btn" style="background-color:#273e52; color:#fff;">Buscar</button>
    </div>
</form>

<a href="{{ route('clientes_comunes.create') }}" class="btn" style="background-color: #273e52; color: #fff; margin-bottom: 20px;">Agregar Cliente</a>

<div class="clientes-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
    @foreach($clientes as $clienteComun)
    <div class="cliente-card" style="background-color: #5583ab; color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: transform 0.3s;">
        <h4>{{ ucwords(strtolower($clienteComun->cliente->nombre_cliente)) }} {{ ucwords(strtolower($clienteComun->cliente->apellido_paterno)) }} {{ ucwords(strtolower($clienteComun->cliente->apellido_materno)) }}</h4>

        <p><strong>Teléfono:</strong> {{ $clienteComun->cliente->telefono }}</p>
        <p><strong>Email:</strong> {{ $clienteComun->cliente->email }}</p>
        <p><strong>Dirección:</strong> {{ $clienteComun->cliente->direccion }}</p>

        <div style="margin-top: 15px; display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('clientes_comunes.edit', $clienteComun->id_cliente) }}" class="btn" style="background-color:#273e52; color:#fff; flex:1;">Editar</a>

            <form id="delete-form-{{ $clienteComun->id_cliente }}" action="{{ route('clientes_comunes.destroy', $clienteComun->id_cliente) }}" method="POST" style="flex:1;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn" style="background-color:#ab5555; color:#fff; width:100%;" onclick="confirmDelete({{ $clienteComun->id_cliente }})">Eliminar</button>
            </form>

            <button class="btn" style="background-color:#f1c40f; color:#000; flex:1;">VIP</button>
        </div>
    </div>
    @endforeach
</div>

<!-- Confirmación de eliminación -->
<div id="confirmation-dialog" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); z-index:1000; align-items: center; justify-content: center;">
    <div style="background-color: #fff; padding: 30px; border-radius: 10px; max-width: 400px; margin: auto; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.3);">
        <p style="font-weight: bold; font-size: 1.2rem;">¿Estás seguro de eliminar este cliente?</p>
        <div style="margin-top: 20px; display: flex; justify-content: space-around;">
            <button id="confirm-btn" style="background-color: #ab5555; color: #fff; border:none; padding:8px 16px; border-radius:4px; cursor: pointer;">Eliminar</button>
            <button id="cancel-btn" style="background-color: #273e52; color: #fff; border:none; padding:8px 16px; border-radius:4px; cursor: pointer;">Cancelar</button>
        </div>
    </div>
</div>

<script>
let userIdToDelete = null;
function confirmDelete(userId) {
    userIdToDelete = userId;
    document.getElementById('confirmation-dialog').style.display = 'flex';
}
document.getElementById('confirm-btn').addEventListener('click', function() {
    if (userIdToDelete) {
        document.getElementById('delete-form-' + userIdToDelete).submit();
    }
    document.getElementById('confirmation-dialog').style.display = 'none';
    userIdToDelete = null;
});
document.getElementById('cancel-btn').addEventListener('click', function() {
    document.getElementById('confirmation-dialog').style.display = 'none';
    userIdToDelete = null;
});

// Hover cards
document.querySelectorAll('.cliente-card').forEach(card => {
    card.addEventListener('mouseenter', () => card.style.transform = 'scale(1.03)');
    card.addEventListener('mouseleave', () => card.style.transform = 'scale(1)');
});
</script>
@endsection
