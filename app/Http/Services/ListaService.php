<?php

namespace App\Http\Services;

use App\Http\Repositories\ListaRepository;
use Exception;

class ListaService {
    public function __construct(
        private ListaRepository $listaRepository
    )
    {}

    public function store(array $data) {
        $this->listaRepository->store($data['name']);
    }
}
