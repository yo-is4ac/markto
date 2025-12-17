<?php

namespace App\Http\Repositories;

use App\Http\Repositories\Contracts\ItemContract;
use App\Models\Item;
use Exception;

class ItemRepository implements ItemContract {
    public function __construct
    (private Item $item){}

    public function store(
        int $listaId,
        string $name,
        string $description,
        int $quantity
    ) {
        $this->item->create([
            'lista_id' => $listaId,
            'name' => $name,
            'description' => $description,
            'quantity' => $quantity
        ]);
    }
}
