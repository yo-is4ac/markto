<?php

namespace App\Http\Services;

use App\Http\Repositories\SharedListaRepository;

class SharedListaService {
    public function __construct
    (private SharedListaRepository $sharedListaRepository){}

    public function store(array $data) {
        $this->sharedListaRepository->store(listaId: $data['lista_id']);
    }
}
