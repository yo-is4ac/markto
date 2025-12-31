<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSharedListaRequest;
use App\Http\Services\SharedListaService;
use App\Models\SharedLista;
use Exception;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class SharedListaController extends Controller
{
    public function __construct(private SharedListaService $sharedListaService) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sharedListas = $this->sharedListaService->index();

        return $sharedListas;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSharedListaRequest $request)
    {
        $lista = $request->user()->lista->where('id', '=', $request->input('lista_id'));
        if ($lista->isEmpty()) throw new Exception('Action not permitted');

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

        if ($sharedLista->lista->user->email !== $request->user()->email) {

            $guests = $sharedLista->can_access;

            $included = false;

            foreach($guests as $guest) {
                if ($guest['email'] === $request->user()->email) {
                    $included = true;
                    break;
                }
            }

            if (! $included) {
                throw new Exception('User has no permissions');
            }
        }

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
