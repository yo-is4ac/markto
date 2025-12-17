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

    public function store(StoreSharedListaRequest $request) {
        $this->sharedListaService->store($request->validated());

        return response()->noContent(201);
    }

    public function show(Request $request, string $code) {
        return SharedLista::where('code', '=', $code)->first()->lista;
    }
}
