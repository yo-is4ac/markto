<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListaRequest;
use App\Http\Services\ListaService;
use Illuminate\Http\Request;
use Exception;


class ListaController extends Controller
{
    public function __construct(
        private ListaService $listaService
    )
    {}

    public function store(StoreListaRequest $request) {
        try {
            $this->listaService->store($request->validated());

            return response()->json([
                'message' => 'created'
            ], 201);

        } catch(Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function index(Request $request) {
        try {
            return $request->user()->lista()->paginate(15);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
