<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\ListaContract;
use App\Models\Lista;

use Exception;

class ListaRepository implements ListaContract {
    public function __construct(
        private Lista $lista
    )
    {
    }

    public function store(string $name) {
        try {
            $this->lista->create([
                'name' => $name
            ]);
        } catch(Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
