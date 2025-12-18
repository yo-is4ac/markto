<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\SharedListaContract;
use App\Models\SharedLista;
use Illuminate\Support\Str;

class SharedListaRepository implements SharedListaContract {
    public function __construct
    (private SharedLista $sharedLista){}

    public function store(string $listaId)
    {
        return $this->sharedLista->create([
            'lista_id' => $listaId,
            'code' => substr(Str::uuid(), 0, 8),
        ]);
    }
}
