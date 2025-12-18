<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListaRequest;
use App\Http\Services\ListaService;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function __construct
    (private ListaService $listaService){}

    public function store(StoreListaRequest $request) {
        $lista = $this->listaService->store($request->validated());

        return response()->json([
            'id' => $lista->id,
            'name' => $lista->name,
            'created_at' => $lista->created_at
        ]);
    }

    public function index(Request $request) {
        $listas = $request->user()->lista->map(function ($lista) {
            return [
                'id' => $lista->id,
                'name' => $lista->name,
                'created_at' => $lista->created_at
            ];
        });


        return json_encode($listas);
    }
}
