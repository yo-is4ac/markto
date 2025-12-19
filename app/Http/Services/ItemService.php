<?php

namespace App\Http\Services;

use App\Http\Repositories\ItemRepository;

class ItemService
{
    public function __construct(private ItemRepository $itemRepository) {}

    public function store(array $data)
    {
        return $this->itemRepository->store(
            $data['lista_id'],
            $data['name'],
            $data['description'],
            $data['quantity']
        );
    }
}
