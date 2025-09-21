<?php

namespace App\Http\Controllers;

use App\Models\Temporada;
use Illuminate\Http\Request;

class TemporadaController extends Controller
{
    public function index()
    {
        $temporadas = Temporada::all();
        return view('temporadas.index', compact('temporadas'));
    }

    public function create()
    {
        return view('temporadas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_temporada' => 'required|string|max:100|unique:temporada',
        ]);

        Temporada::create($request->all());

        return redirect()->route('temporadas.index')->with('success', 'Temporada creada correctamente.');
    }

    public function edit($id)
    {
        $temporada = Temporada::findOrFail($id);
        return view('temporadas.edit', compact('temporada'));
    }

    public function update(Request $request, $id)
    {
        $temporada = Temporada::findOrFail($id);

        $request->validate([
            'nombre_temporada' => 'required|string|max:100|unique:temporada,nombre_temporada,' . $temporada->id_temporada . ',id_temporada',
        ]);

        $temporada->update($request->all());

        return redirect()->route('temporadas.index')->with('success', 'Temporada actualizada correctamente.');
    }

    public function destroy($id)
    {
        $temporada = Temporada::findOrFail($id);
        $temporada->delete();

        return redirect()->route('temporadas.index')->with('success', 'Temporada eliminada correctamente.');
    }
}
