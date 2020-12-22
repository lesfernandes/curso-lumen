<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\Request;

class SeriesController
{
    public function index()
    {
        return Serie::all();
    }

    public function store(Request $request)
    {
        return response()
                ->json(
                    Serie::create(['nome' => $request->nome]),
                    201
                );
    }

    public function show(int $id)
    {
        $serie = Serie::find($id);

        if(is_null($serie)) {
            return response()->json('', 204);
        }

        return response()->json($serie);
    }

    public function update(int $id, Request $request)
    {
        $serie = Serie::find($id);
        if(is_null($serie)) {
            return response()->json(['erro' => 'Recurso não encontrado.'], 404);
        }
        // função 'fill' preenche o objeto de acordo com os parâmetros
        $serie->fill($request->all());
        $serie->save();
    }
}
