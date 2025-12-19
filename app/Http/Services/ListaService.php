<?php

namespace App\Http\Services;

use App\Http\Repositories\ListaRepository;

class ListaService
{
    public function __construct(private ListaRepository $listaRepository) {}

    public function store(array $data)
    {
        return $this->listaRepository->store($data['name']);
    }

    public function show() {}
}
