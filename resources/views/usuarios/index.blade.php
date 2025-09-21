@extends('layout')

@section('title', 'Usuarios')

@section('content')
<h2 class="mb-4" style="color:#fff;">Gestión de Usuarios</h2>

<a href="{{ route('usuarios.create') }}" class="btn" style="background-color: #273e52; color: #fff; margin-bottom: 20px;">Agregar Usuario</a>

<form method="GET" action="{{ route('usuarios.index') }}" style="margin-bottom:20px;">
    
</form>

<div class="usuarios-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
    @foreach($usuarios as $usuario)
    <div class="usuario-card" style="background-color: #5583ab; color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: transform 0.3s;">
        <h4>{{ $usuario->nombre_completo }}</h4>

        <p><strong>Nombre de Usuario:</strong> {{ $usuario->nombre }}</p>
        <p><strong>Rol:</strong> {{ $usuario->rol->nombre_rol ?? 'Sin rol' }}</p>

        <div style="margin-top: 15px; display:flex; gap:10px; flex-wrap:wrap;">
            <a href="{{ route('usuarios.edit', $usuario->id_usuario) }}" class="btn" style="background-color:#273e52; color:#fff; flex:1;">Editar</a>
            
            <form id="delete-form-{{ $usuario->id_usuario }}" action="{{ route('usuarios.destroy', $usuario->id_usuario) }}" method="POST" style="flex:1;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn" style="background-color:#ab5555; color:#fff; width:100%;" onclick="confirmDelete({{ $usuario->id_usuario }})">Eliminar</button>
            </form>
        </div>
    </div>
    @endforeach
</div>

<div id="confirmation-dialog" style="display:none; position: fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.5); z-index:1000; align-items: center; justify-content: center;">
    <div style="background-color: #fff; padding: 30px; border-radius: 10px; max-width: 400px; margin: auto; text-align: center; box-shadow: 0 4px 10px rgba(0,0,0,0.3); color: #000;">
        <p style="font-weight: bold; font-size: 1.2rem;">¿Estás seguro de eliminar a este usuario?</p>
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

    // Efecto hover en tarjetas
    document.querySelectorAll('.usuario-card').forEach(card => {
        card.addEventListener('mouseenter', () => card.style.transform = 'scale(1.03)');
        card.addEventListener('mouseleave', () => card.style.transform = 'scale(1)');
    });
</script>
@endsection