<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreListaRequest;
use App\Http\Resources\ListaResource;
use App\Http\Services\ListaService;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function __construct(private ListaService $listaService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response($this->listaService->index());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreListaRequest $request)
    {
        $lista = $this->listaService->store($request->validated());

        return response()->json(
            new ListaResource($lista)
        , 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $lista = $this->listaService->show($id);

        return response(new ListaResource($lista));
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
