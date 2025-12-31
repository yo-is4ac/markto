<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\ItemContract;
use App\Models\Item;

class ItemRepository implements ItemContract
{
    public function __construct(private Item $item) {}

    public function store(
        int $listaId,
        string $name,
        string $description,
        int $quantity
    ) {
        return $this->item->create([
            'lista_id' => $listaId,
            'name' => $name,
            'description' => $description,
            'quantity' => $quantity,
        ]);
    }

    public function show(string $id)
    {
        return $this->item->where('id', '=', $id)->first();
    }
}
