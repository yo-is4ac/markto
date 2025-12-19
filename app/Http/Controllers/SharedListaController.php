<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSharedListaRequest;
use App\Http\Services\SharedListaService;
use App\Models\SharedLista;
use Illuminate\Http\Request;

class SharedListaController extends Controller
{
    public function __construct(private SharedListaService $sharedListaService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreSharedListaRequest $request)
    {
        $sharedLista = $this->sharedListaService->store($request->validated());

        return response()->json([
            'code' => $sharedLista->code,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $code)
    {
        $sharedLista = SharedLista::where('code', '=', $code)->first();

        return response()->json([
            'lista' => $sharedLista->lista->name,
            'item' => array_map(function ($lista) {
                return [
                    'id' => $lista['id'],
                    'name' => $lista['name'],
                    'description' => $lista['description'],
                    'quantity' => $lista['quantity'],
                    'created_at' => $lista['created_at'],
                ];
            }, $sharedLista->lista->item->toArray()),
        ]);
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
