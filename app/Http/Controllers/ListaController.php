<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListaRequest;
use Exception;
use App\Http\Services\ListaService;


class ListaController extends Controller
{
    public function __construct(
        private ListaService $listaService
    )
    {
    }

    public function store(StoreListaRequest $request) {
        try {
            $this->listaService->store($request->validated());

            return response()->json([
                'status' => 'ok',
                'message' => 'created'
            ], 201);

        } catch(Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
