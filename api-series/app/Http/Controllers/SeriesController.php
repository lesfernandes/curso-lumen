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

    public function get(int $id)
    {
        $serie = Serie::find($id);

        if(is_null($serie)) {
            return response()->json('', 204);
        }

        return response()->json($serie);
    }
}
