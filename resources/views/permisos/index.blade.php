@extends('layout')

@section('title', 'Permisos')

@section('content')
    <h2 class="mb-4" style="color:#fff;">Gestión de Permisos</h2>

    <div class="usuarios-grid" style="display:grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
        @foreach($usuarios as $usuario)
            <div class="usuario-card" style="background-color: #5583ab; color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: transform 0.3s;">
                <h4>{{ $usuario->nombre_completo }}</h4>
                <p><strong>Nombre de Usuario:</strong> {{ $usuario->nombre }}</p>
                <p><strong>Rol:</strong> {{ $usuario->rol->nombre_rol ?? 'Sin rol' }}</p>

                <div style="margin-top: 15px;">
                    <!-- Botón para abrir modal -->
                    <button class="btn" style="background-color:#273e52; color:#fff; width:100%;" data-bs-toggle="modal" data-bs-target="#permisosModal{{ $usuario->id_usuario }}">
                        Permisos
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="permisosModal{{ $usuario->id_usuario }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="background:#fff; color:#000; border-radius:10px; padding:20px;">
                        <div class="modal-header">
                            <h5 class="modal-title">Permisos de {{ $usuario->nombre_completo }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="usuarios{{ $usuario->id_usuario }}">
                                    <label class="form-check-label" for="usuarios{{ $usuario->id_usuario }}">Usuarios</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="clientes{{ $usuario->id_usuario }}">
                                    <label class="form-check-label" for="clientes{{ $usuario->id_usuario }}">Clientes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="productos{{ $usuario->id_usuario }}">
                                    <label class="form-check-label" for="productos{{ $usuario->id_usuario }}">Productos</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="ventas{{ $usuario->id_usuario }}">
                                    <label class="form-check-label" for="ventas{{ $usuario->id_usuario }}">Ventas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="inventarios{{ $usuario->id_usuario }}">
                                    <label class="form-check-label" for="inventarios{{ $usuario->id_usuario }}">Inventarios</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="inventarios{{ $usuario->id_usuario }}">
                                    <label class="form-check-label" for="inventarios{{ $usuario->id_usuario }}">Permisos</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="inventarios{{ $usuario->id_usuario }}">
                                    <label class="form-check-label" for="inventarios{{ $usuario->id_usuario }}">Detalle de venta</label>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">Guardar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script>
        // Efecto hover en tarjetas
        document.querySelectorAll('.usuario-card').forEach(card => {
            card.addEventListener('mouseenter', () => card.style.transform = 'scale(1.03)');
            card.addEventListener('mouseleave', () => card.style.transform = 'scale(1)');
        });
    </script>
@endsection
