<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSharedListaRequest;
use App\Http\Services\SharedListaService;
use App\Models\SharedLista;

class SharedListaController extends Controller
{
    public function __construct
    (private SharedListaService $sharedListaService){}

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
    public function store(StoreSharedListaRequest $request) {
        $sharedLista = $this->sharedListaService->store($request->validated());

        return response()->json([
            'code' => $sharedLista->code
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, string $code) {
        $sharedLista =  SharedLista::where('code', '=', $code)->first();
        $lista = $sharedLista->lista;

        foreach($lista->item as $index => $item) {
            $items[$index] = [
                'name' => $item->name,
                'description' => $item->description,
                'quantity' => $item->quantity
            ];
        }

        $guests = json_decode($sharedLista->can_access);

        foreach($guests as $guest) {
            if ($guest->guest === $request->user()->email) {
                return response()->json([
                    'code' => $sharedLista->code,
                    'name' => $lista->name,
                    'items' => $items
                ]);
            }
        }

        return response()->noContent(421);
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
