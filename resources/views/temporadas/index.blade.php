@extends('layout')

@section('title', 'Temporadas')

@section('content')
<h2 class="mb-4" style="color:#fff;">Temporadas</h2>

<!--<a href="{{ route('temporadas.create') }}" class="btn mb-3" style="background-color:#273e52; color:#fff;">Agregar Temporada</a>-->

<table class="table table-striped table-bordered" style="background-color:#fff;">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($temporadas as $temporada)
        <tr>
            <td>{{ $temporada->id_temporada }}</td>
            <td>{{ $temporada->nombre_temporada }}</td>
            <td>
                <a href="{{ route('temporadas.edit', $temporada->id_temporada) }}" class="btn btn-primary btn-sm">Editar</a>
                
                <form action="{{ route('temporadas.destroy', $temporada->id_temporada) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Deseas eliminar esta temporada?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
