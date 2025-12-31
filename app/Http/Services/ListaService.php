<?php

namespace App\Http\Services;

use App\Http\Repositories\ListaRepository;
use Exception;

class ListaService
{
    public function __construct(private ListaRepository $listaRepository) {}

    public function index() {
        return $this->listaRepository->index();
    }

    public function store(array $data)
    {
        return $this->listaRepository->store($data['name']);
    }

    public function show(string $id) {
        $lista = $this->listaRepository->show($id);

        if (empty($lista)) throw new Exception('Not Found');

        return $lista;
    }
}
