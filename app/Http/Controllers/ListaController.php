<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListaRequest;
use App\Http\Services\ListaService;
use Exception;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function __construct(private ListaService $listaService) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $listas = $request->user()->lista->map(function ($lista) {

            return [
                'id' => $lista->id,
                'name' => $lista->name,
                'created_at' => $lista->created_at,
            ];
        });

        return response()->json($listas);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListaRequest $request)
    {
        $lista = $this->listaService->store($request->validated());

        return response()->json([
            'id' => $lista->id,
            'name' => $lista->name,
            'created_at' => $lista->created_at,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $lista = $request->user()->lista->where('id', '=', $id)->first();

        if ($lista === null) {
            throw new Exception('Lista Not Found');
        }

        return $lista;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
