<?php

namespace App\Http\Controllers;

use App\Models\Episodio;
use Illuminate\Http\Request;

class EpisodiosController
{
    public function index()
    {
        return Episodio::all();
    }

    public function store(Request $request)
    {
        return response()
                ->json(
                    Episodio::create(['nome' => $request->nome]),
                    201
                );
    }

    public function show(int $id)
    {
        $episodio = Episodio::find($id);

        if(is_null($episodio)) {
            return response()->json('', 204);
        }

        return response()->json($episodio);
    }

    public function update(int $id, Request $request)
    {
        $episodio = Episodio::find($id);
        if(is_null($episodio)) {
            return response()->json(['erro' => 'Recurso não encontrado.'], 404);
        }
        // função 'fill' preenche o objeto de acordo com os parâmetros
        $episodio->fill($request->all());
        $episodio->save();
    }

    public function destroy(int $id)
    {
        $quantidadeRecursosRemovidos = Episodio::destroy($id);
        if ($quantidadeRecursosRemovidos === 0){
            return response()->json([
                'erro' => 'Recurso não encontrado.'
            ], 404);
        }
        return response()->json('', 204);
    }
}
