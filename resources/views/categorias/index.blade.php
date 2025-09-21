@extends('layout')

@section('title', 'Categorías')

@section('content')
<h2 class="mb-4" style="color:#fff;">Categorías</h2>

<a href="{{ route('categorias.create') }}" class="btn mb-3" style="background-color:#273e52; color:#fff;">Agregar Categoría</a>

<table class="table table-striped table-bordered" style="background-color:#fff;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categorias as $categoria)
        <tr>
            <td>{{ $categoria->id_categoria }}</td>
            <td>{{ $categoria->nombre_categoria }}</td>
            <td>
                <a href="{{ route('categorias.edit', $categoria->id_categoria) }}" class="btn btn-primary btn-sm">Editar</a>
                
                <form action="{{ route('categorias.destroy', $categoria->id_categoria) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar esta categoría?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
