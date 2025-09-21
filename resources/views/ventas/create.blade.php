@extends('layout')

@section('title', 'Registrar Venta')

@section('content')
<div class="container mt-4">
    <h2>Registrar Venta</h2>

    {{-- Mensajes --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('ventas.store') }}" method="POST" id="form-venta">
        @csrf

        {{-- Cliente --}}
        <div class="form-group mb-3">
            <label for="id_cliente">Cliente</label>
            <select name="id_cliente" id="id_cliente" class="form-control select2" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id_cliente }}" data-descuento="{{ $cliente->vip ? $cliente->vip->porcentaje_descuento : 0 }}">
                        {{ ucfirst(strtolower($cliente->nombre_cliente)) }} 
                        {{ ucfirst(strtolower($cliente->apellido_paterno)) }} 
                        {{ ucfirst(strtolower($cliente->apellido_materno)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <input type="hidden" name="id_usuario" value="{{ Auth::user()->id_usuario }}">

        {{-- Fecha --}}
        <div class="form-group mb-3">
            <label for="fecha">Fecha</label>
            <input type="datetime-local" name="fecha" class="form-control" value="{{ now()->format('Y-m-d\TH:i') }}" required>
        </div>

        {{-- Productos dinámicos --}}
        <h4>Productos</h4>
        <table class="table" id="productos-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                    <th>
                        <button type="button" id="agregar-producto" class="btn btn-success btn-sm">+</button>
                    </th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        {{-- Total --}}
        <div class="form-group mb-3">
            <label for="total">Total</label>
            <input type="number" step="0.01" name="total" id="total" class="form-control" readonly>
        </div>

        <button type="submit" class="btn btn-success">Guardar Venta</button>
    </form>
</div>

{{-- Scripts --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    $('#id_cliente').select2({
        placeholder: 'Buscar cliente...',
        allowClear: true,
        width: '100%'
    });

    let productos = @json($productos);
    let contador = 0;
    let descuento = 0;

    // Detectar cambio de cliente y actualizar descuento solo si es VIP
    $('#id_cliente').on('change', function() {
        descuento = parseFloat($(this).find('option:selected').data('descuento')) || 0;
        recalcularTotal();
    });

    function recalcularTotal() {
        let total = 0;
        $('.subtotal').each(function() {
            let val = parseFloat($(this).val()) || 0;
            total += val;
        });
        total = total * (1 - descuento / 100);
        $('#total').val(total.toFixed(2));
    }

    // Agregar producto
    $(document).on('click', '#agregar-producto', function() {
        let options = productos.map(p => `<option value="${p.id_producto}" data-precio="${p.precio}" data-stock="${p.stock_actual}">${p.nombre} (Stock: ${p.stock_actual})</option>`).join('');
        let fila = `<tr data-id="${contador}">
            <td>
                <select name="productos[${contador}][id_producto]" class="form-control producto-select" required>
                    <option value="">Seleccione un producto</option>
                    ${options}
                </select>
            </td>
            <td><input type="number" name="productos[${contador}][cantidad]" class="form-control cantidad" min="1" value="1" required></td>
            <td><input type="number" name="productos[${contador}][precio_unitario]" class="form-control precio" readonly></td>
            <td><input type="number" name="productos[${contador}][subtotal]" class="form-control subtotal" readonly></td>
            <td><button type="button" class="btn btn-danger btn-sm eliminar">x</button></td>
        </tr>`;
        $('#productos-table tbody').append(fila);
        contador++;
    });

    // Calcular subtotal al cambiar producto o cantidad
    $(document).on('input change', '.producto-select, .cantidad', function() {
        let fila = $(this).closest('tr');
        let productoSelect = fila.find('.producto-select option:selected');
        let precio = parseFloat(productoSelect.data('precio')) || 0;
        let stock = parseInt(productoSelect.data('stock')) || 0;
        let cantidad = parseInt(fila.find('.cantidad').val()) || 0;

        // Validar stock
        if (cantidad > stock) {
            alert(`Stock insuficiente. Stock actual: ${stock}`);
            fila.find('.cantidad').val(stock > 0 ? stock : 0);
            cantidad = parseInt(fila.find('.cantidad').val());
        }

        let subtotal = precio * cantidad;
        fila.find('.precio').val(precio.toFixed(2));
        fila.find('.subtotal').val(subtotal.toFixed(2));

        recalcularTotal();
    });

    // Eliminar fila
    $(document).on('click', '.eliminar', function() {
        $(this).closest('tr').remove();
        recalcularTotal();
    });
});
</script>
@endsection
