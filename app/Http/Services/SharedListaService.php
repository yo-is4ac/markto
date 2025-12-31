<?php

namespace App\Http\Services;

use App\Http\Repositories\SharedListaRepository;
use App\Http\Resources\SharedListaResource;

class SharedListaService
{
    public function __construct(private SharedListaRepository $sharedListaRepository) {}

    public function index() {
        //return $this->sharedListaRepository->index()->map(function ($sharedLista) {
        //    return new SharedListaResource($sharedLista);
        //});

        return $this->sharedListaRepository->index();
    }

    public function store(array $data)
    {
        return $this->sharedListaRepository->store(listaId: $data['lista_id']);
    }
}
