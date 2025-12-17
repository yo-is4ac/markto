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
        $this->listaService->store($request->validated());

        return response()->noContent(201);
    }

    public function index(Request $request) {
        return $request->user()->lista()->paginate(15);
    }
}
