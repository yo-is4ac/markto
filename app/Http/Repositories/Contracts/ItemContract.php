<?php

namespace App\Http\Repositories\Contracts;

interface ItemContract
{
    public function store(
        int $listaId,
        string $name,
        string $description,
        int $quantity
    );

    public function show(
        string $id
    );
}
